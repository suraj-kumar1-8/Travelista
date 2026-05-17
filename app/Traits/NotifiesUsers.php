<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Str;

trait NotifiesUsers
{
    /**
     * Notify all users about new content.
     */
    protected function notifyNewContent(string $type, string $title, array $extraData = [])
    {
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            Notification::create([
                'id' => (string) Str::uuid(),
                'type' => $type,
                'notifiable_type' => get_class($user),
                'notifiable_id' => $user->id,
                'data' => array_merge([
                    'title' => $title,
                    'message' => "New " . str_replace('_', ' ', $type) . ": " . $title,
                ], $extraData),
            ]);
        }
    }
}
