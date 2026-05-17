<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            'Jammu & Kashmir',
            'Himachal Pradesh',
            'Uttarakhand',
            'Rajasthan',
            'Goa',
            'Kerala',
            'Sikkim',
            'Meghalaya',
            'Ladakh',
            'Andaman',
            'Karnataka',
            'Tamil Nadu',
            'Maharashtra',
            'Gujarat',
            'Punjab',
            'Uttar Pradesh',
            'Bihar',
            'Assam',
            'Arunachal Pradesh',
            'Lakshadweep'
        ];

        foreach ($states as $state) {
            State::updateOrCreate(
                ['name' => $state],
                ['status' => 'active']
            );
        }

        // Deactivate foreign states if they exist
        State::whereNotIn('name', $states)->update(['status' => 'inactive']);
    }
}
