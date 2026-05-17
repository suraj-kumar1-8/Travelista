<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\State;
use Illuminate\Database\Seeder;

class MapDestinationsToStatesSeeder extends Seeder
{
    public function run(): void
    {
        $mapping = [
            'Kashmir' => 'Jammu & Kashmir',
            'Goa' => 'Goa',
            'Manali' => 'Himachal Pradesh',
            'Kerala' => 'Kerala',
            'Rajasthan' => 'Rajasthan',
            'Jaipur' => 'Rajasthan',
            'Udaipur' => 'Rajasthan',
            'Shimla' => 'Himachal Pradesh',
            'Leh Ladakh' => 'Ladakh',
            'Darjeeling' => 'West Bengal',
            'Amritsar' => 'Punjab',
            'Ooty' => 'Tamil Nadu',
            'Varanasi' => 'Uttar Pradesh',
            'Bodh Gaya' => 'Bihar',
            'Rann of Kutch' => 'Gujarat',
            'Mumbai' => 'Maharashtra',
            'Gangtok' => 'Sikkim',
            'Rishikesh' => 'Uttarakhand',
            'Coorg' => 'Karnataka',
            'Shillong' => 'Meghalaya',
            'Kaziranga' => 'Assam',
            'Tawang' => 'Arunachal Pradesh',
            'Havelock Island' => 'Andaman',
            'Agatti' => 'Lakshadweep'
        ];

        foreach ($mapping as $destName => $stateName) {
            $state = State::where('name', $stateName)->first();
            if ($state) {
                Destination::where('name', 'like', '%'.$destName.'%')->update(['state_id' => $state->id]);
            }
        }
    }
}
