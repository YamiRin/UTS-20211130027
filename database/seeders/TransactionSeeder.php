<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $type = $faker->randomElement(['income', 'expense']);
            $category = $type == 'income' ? $faker->randomElement(['wage', 'bonus', 'gift']) : $faker->randomElement(['food & drinks', 'shopping', 'charity', 'housing', 'insurance', 'taxes', 'transportation']);

            $amount = $type == 'income' ? $faker->randomFloat(2, 100000, 1000000) : $faker->randomFloat(2, 1000, 100000);

            \App\Models\Transaction::create([
                'amount' => $amount,
                'type' => $type,
                'category' => $category,
                'notes' => $faker->text,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }

    }
}
