<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Exámenes', 'Proyectos', 'Participación'] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}