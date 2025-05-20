<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    public function run(): void
    {
        $priorities = [
            ['name' => 'Alta',  'color' => '#dc2626'],
            ['name' => 'Media', 'color' => '#facc15'],
            ['name' => 'Baja',  'color' => '#16a34a'],
        ];

        foreach ($priorities as $priority) {
            Priority::firstOrCreate(['name' => $priority['name']], $priority);
        }
    }
}
