<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Pemula',
            ],
            [
                'nama' => 'Menengah',
            ],
            [
                'nama' => 'Lanjutan',
            ],
            [
                'nama' => 'Keluarga',
            ],
        ];

        foreach ($user as $key => $value) {
            Category::create($value);
        }
    }
}
