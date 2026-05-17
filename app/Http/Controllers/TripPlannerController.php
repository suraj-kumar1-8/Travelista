<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\TripPlan;
use App\Services\TripPlannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripPlannerController extends Controller
{
    /**
     * Show the trip planning form (alias for create).
     */
    public function index()
    {
        return $this->create();
    }

    /**
     * Show the trip planning form view.
     */
    public function create()
    {
        $states = State::where('status', 'active')->orderBy('name')->get();
        return view('trip-planner.index', compact('states'));
    }

    /**
     * Provide suggestions without persisting a trip plan.
     */
    public function suggest(Request $request, TripPlannerService $service)
    {
        $validated = $request->validate([
            'budget' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
            'travel_type' => 'required|in:adventure,honeymoon,family,religious,budget',
            'state_id' => 'required|exists:states,id',
            'travelers' => 'nullable|integer|min:1',
        ]);

        $tempPlan = new TripPlan($validated + ['user_id' => Auth::id()]);
        $suggestions = $service->suggest($tempPlan);

        return response()->json(['suggestions' => $suggestions]);
    }

    /**
     * Store the user's preferences and generate suggestions (persist plan).
     */
    public function store(Request $request, TripPlannerService $service)
    {
        $validated = $request->validate([
            'budget' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
            'travel_type' => 'required|in:adventure,honeymoon,family,religious,budget',
            'state_id' => 'required|exists:states,id',
            'travelers' => 'nullable|integer|min:1',
        ]);

        if (Auth::check()) {
            $tripPlan = TripPlan::create(array_merge($validated, ['user_id' => Auth::id()]));
        } else {
            $tripPlan = new TripPlan($validated);
        }

        $suggestions = $service->suggest($tripPlan);

        return response()->json([
            'trip_plan_id' => $tripPlan->id ?? null,
            'suggestions' => $suggestions,
        ]);
    }

    /**
     * Calculate expense based on user input.
     */
    public function calculateExpense(Request $request, TripPlannerService $service)
    {
        $validated = $request->validate([
            'budget' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
            'travel_type' => 'required|in:adventure,honeymoon,family,religious,budget',
            'state_id' => 'nullable|exists:states,id',
            'travelers' => 'required|integer|min:1',
        ]);

        $tempPlan = new TripPlan($validated + ['user_id' => Auth::id()]);
        $expense = $service->calculateExpense($tempPlan);

        return response()->json(['expense' => $expense]);
    }
}
