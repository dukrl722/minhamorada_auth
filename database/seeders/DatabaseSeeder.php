<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Users;
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
        Users::factory(5)->create();
        Address::factory(5)->create();
    }
}
