<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(AdminShopUserTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(ShopRepresentativesTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);

    }
}
