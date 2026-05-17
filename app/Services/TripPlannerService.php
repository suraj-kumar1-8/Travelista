<?php

namespace App\Services;

use App\Models\TripPlan;
use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\Hotel;

class TripPlannerService
{
    /**
     * Generate suggestions based on a trip plan.
     */
    public function suggest(TripPlan $plan)
    {
        $destinations = Destination::where('state_id', $plan->state_id)
            ->where('status', 'active')
            ->take(3)
            ->get();

        $packages = TourPackage::whereHas('destination', function ($query) use ($plan) {
                $query->where('state_id', $plan->state_id);
            })
            ->where('price', '<=', $plan->budget)
            ->where('duration_days', '<=', $plan->days)
            ->take(3)
            ->get();

        $hotels = Hotel::whereHas('destination', function ($query) use ($plan) {
                $query->where('state_id', $plan->state_id);
            })
            ->where('price_per_night', '<=', $plan->budget / $plan->days)
            ->take(3)
            ->get();

        $activities = $this->getSuggestedActivities($plan->travel_type);

        return [
            'destinations' => $destinations,
            'packages' => $packages,
            'hotels' => $hotels,
            'activities' => $activities,
        ];
    }

    /**
     * Calculate estimated expenses.
     */
    public function calculateExpense(TripPlan $plan)
    {
        $days = max(1, $plan->days);
        $travelers = max(1, $plan->travelers);
        
        // Base costs per person per day (Indian Pricing)
        $costs = [
            'adventure' => ['hotel' => 3000, 'food' => 1500, 'transport' => 2000, 'activities' => 2500],
            'honeymoon' => ['hotel' => 8000, 'food' => 3000, 'transport' => 4000, 'activities' => 2000],
            'family'    => ['hotel' => 5000, 'food' => 2500, 'transport' => 3000, 'activities' => 1500],
            'religious' => ['hotel' => 2000, 'food' => 1000, 'transport' => 1500, 'activities' => 500],
            'budget'    => ['hotel' => 1000, 'food' => 600, 'transport' => 800, 'activities' => 400],
        ];

        $base = $costs[$plan->travel_type] ?? $costs['adventure'];
        
        $hotelTotal = $base['hotel'] * $days * ceil($travelers / 2); // 2 people per room
        $foodTotal = $base['food'] * $days * $travelers;
        $transportTotal = $base['transport'] * $days * $travelers;
        $activityTotal = $base['activities'] * $travelers;

        $subtotal = $hotelTotal + $foodTotal + $transportTotal + $activityTotal;
        $taxes = $subtotal * 0.18; // 18% GST
        $total = $subtotal + $taxes;

        return [
            'hotel_cost' => round($hotelTotal, 2),
            'food_cost' => round($foodTotal, 2),
            'transport_cost' => round($transportTotal, 2),
            'activity_cost' => round($activityTotal, 2),
            'taxes' => round($taxes, 2),
            'estimated_total' => round($total, 2),
        ];
    }

    /**
     * Get static activity suggestions based on travel type.
     */
    private function getSuggestedActivities($type)
    {
        $activities = [
            'adventure' => ['Trekking', 'River Rafting', 'Paragliding', 'Mountain Biking', 'Camping'],
            'honeymoon' => ['Candlelight Dinner', 'Sunset Cruise', 'Spa Retreat', 'Private Guided Tour', 'Flower Garden Visit'],
            'family' => ['Museum Visit', 'Zoo Trip', 'Local Fair', 'Theme Park', 'Cultural Show'],
            'religious' => ['Temple Visit', 'Ganga Aarti', 'Spiritual Discourse', 'Meditation Session', 'Historical Pilgrimage'],
            'budget' => ['Local Bus Tour', 'Street Food Crawl', 'Free Museum Entry', 'Public Park Visit', 'Market Exploration'],
        ];

        return $activities[$type] ?? $activities['adventure'];
    }
}
