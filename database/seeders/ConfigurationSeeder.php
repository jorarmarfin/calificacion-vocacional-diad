<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurations')->insert([
            [
                'key' => 'T1',
                'names' => 'Titulo del examen',
                'value' => 'Examen de aptitud vocacional',
            ],
            [
                'key' => 'T2',
                'names' => 'Titulo del examen',
                'value' => 'Examen de aptitud vocacional',
            ],
        ]);
    }
}
