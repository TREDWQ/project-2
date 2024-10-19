<?php

namespace Database\Seeders;

use App\Models\lessontag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        lessontag::factory(500)->create();
    }
}
