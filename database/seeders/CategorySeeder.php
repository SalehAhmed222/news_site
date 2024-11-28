<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['technology  category', 'sports  category', 'fahion  category'];
        $date = fake()->date('Y-m-d h:m:s');

        foreach ($data as $item) {
            Category::create([
                'name' => $item,
                'status' => 1,
                'slug' => Str::slug($item),
                'created_at' => $date,
                'updated_at' => $date, //frist way for slug
            ]);
        }
    }
}
