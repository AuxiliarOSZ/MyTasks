<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Pendiente',
            'En Progreso',
            'En Revisión',
            'Completada',
            'Cancelada',
        ];

        foreach ($statuses as $name) {
            Status::firstOrCreate(['name' => $name]);
        }
    }
}
