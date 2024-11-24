<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $faker = \Faker\Factory::create('id_ID');
        $categories = [
            'Makanan',
            'Minuman',
            'Pakaian',
            'Elektronik',
            'Kesehatan',
            'Olahraga',
            'Hobi',
            'Kecantikan',
            'Perabotan',
            'Lainnya',
        ];
        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category,
            ]);
        }
        $prices = [
            1000,
            2000,
            3000,
            4000,
            5000,
            6000,
            7000,
            8000,
            9000,
            10000,
            20000,
            30000,
            40000,
            50000,
            60000,
            70000,
            80000,
            90000,
            100000,
        ];
        for ($i = 0; $i < 100; $i++) {
            $price = $faker->randomElement($prices);
            \App\Models\Product::create([
                'name' => $faker->words(2, true),
                'selling_price' => $price + ($price * 0.3),
                'purchase_price' => $price,
                'stock' => $faker->numberBetween(1, 100),
                'foto' => "https://picsum.photos/200",
                'category_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
