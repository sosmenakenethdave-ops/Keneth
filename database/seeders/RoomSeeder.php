<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room; // Siguraduhing tama ang pangalan ng iyong Model (Room o RoomModel)

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => 'Room 1', 'building' => 'CICT Building', 'capacity' => 40],
            ['name' => 'Room 2', 'building' => 'CICT Building', 'capacity' => 40],
            ['name' => 'Room 3', 'building' => 'CICT Building', 'capacity' => 45],
            ['name' => 'Room 4', 'building' => 'Main Academic Building', 'capacity' => 35],
            ['name' => 'Room 5', 'building' => 'Main Academic Building', 'capacity' => 35],
            ['name' => 'Lecture Hall A', 'building' => 'CICT Building', 'capacity' => 50],
            ['name' => 'Lecture Hall B', 'building' => 'CICT Building', 'capacity' => 50],
            ['name' => 'Networking Lab', 'building' => 'CICT Building', 'capacity' => 30],
        ];

        foreach ($rooms as $roomData) {
            Room::updateOrCreate(
                ['name' => $roomData['name']], // Para maiwasan ang duplicate kung i-run ulit
                $roomData
            );
        }
    }
}