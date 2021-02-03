<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * php artisan db:seed --class=UserSeeder
     *
     * @return void
     */
    public function run()
    {
        $this->call(PostSeeder::class);
    }
}