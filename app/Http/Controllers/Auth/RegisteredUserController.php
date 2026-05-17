<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'string', 'max:50'],
        ]);

        $referrer = null;
        if ($request->filled('referral_code')) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
        }

        $generatedCode = 'TRV-' . strtoupper(str()->random(8));
        while (User::where('referral_code', $generatedCode)->exists()) {
            $generatedCode = 'TRV-' . strtoupper(str()->random(8));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $generatedCode,
            'referred_by' => $referrer?->id,
        ]);

        if ($referrer) {
            $referrer->increment('reward_points', 200);
            $referrer->increment('wallet_balance', 200);

            \App\Models\ReferralLog::create([
                'referrer_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'reward_points' => 200,
                'reward_amount' => 200,
            ]);

            \App\Models\WalletTransaction::create([
                'user_id' => $referrer->id,
                'type' => 'referral_bonus',
                'amount' => 200,
                'balance_after' => $referrer->wallet_balance,
                'reference' => $user->id,
                'meta' => ['reason' => 'Referral signup bonus'],
            ]);
        }

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'id' => (string) Str::uuid(),
                'type' => 'admin_new_user',
                'notifiable_type' => get_class($admin),
                'notifiable_id' => $admin->id,
                'data' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
