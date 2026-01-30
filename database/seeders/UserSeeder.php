<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Pregunta1',
                'email' => 'pregunta1@uni.edu.pe',
                'password' => bcrypt('pregunta1'),
            ],
            [
                'name' => 'Pregunta2',
                'email' => 'pregunta2@uni.edu.pe',
                'password' => bcrypt('pregunta2'),
            ],
            [
                'name' => 'Pregunta3',
                'email' => 'pregunta3@uni.edu.pe',
                'password' => bcrypt('pregunta3'),
            ],
            [
                'name' => 'Pregunta4',
                'email' => 'pregunta4@uni.edu.pe',
                'password' => bcrypt('pregunta4'),
            ],
            [
                'name' => 'Pregunta5',
                'email' => 'pregunta5@uni.edu.pe',
                'password' => bcrypt('pregunta5'),
            ],
            [
                'name' => 'Pregunta6',
                'email' => 'pregunta6@uni.edu.pe',
                'password' => bcrypt('pregunta6'),
            ],
            [
                'name' => 'Pregunta7',
                'email' => 'pregunta7@uni.edu.pe',
                'password' => bcrypt('pregunta7'),
            ],
            [
                'name' => 'Pregunta8',
                'email' => 'pregunta8@uni.edu.pe',
                'password' => bcrypt('pregunta8'),
            ],
            [
                'name' => 'Pregunta9',
                'email' => 'pregunta9@uni.edu.pe',
                'password' => bcrypt('pregunta9'),
            ],
            [
                'name' => 'Pregunta10',
                'email' => 'pregunta10@uni.edu.pe',
                'password' => bcrypt('pregunta10'),
            ],

        ]);
    }
}
