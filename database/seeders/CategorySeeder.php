<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined income categories
        $incomeCategories = [
            'Salary' => '#28a745',
            'Freelance' => '#17a2b8',
            'Investments' => '#ffc107',
            'Rental Income' => '#6f42c1',
            'Business' => '#fd7e14',
        ];

        // Predefined expense categories
        $expenseCategories = [
            'Food & Dining' => '#dc3545',
            'Transportation' => '#6c757d',
            'Housing' => '#20c997',
            'Healthcare' => '#e83e8c',
            'Entertainment' => '#007bff',
        ];

        // Create income categories
        foreach ($incomeCategories as $name => $color) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->sentence(),
                'color' => $color,
                'type' => 'income',
            ]);
        }

        // Create expense categories
        foreach ($expenseCategories as $name => $color) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->sentence(),
                'color' => $color,
                'type' => 'expense',
            ]);
        }

        // // Create additional random categories
        // Category::factory()->count(10)->create();
    }
}
