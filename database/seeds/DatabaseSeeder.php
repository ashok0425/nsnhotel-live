<?php

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
        // $this->call(UsersTableSeeder::class);
         for ($i=17; $i < 1100; $i++) { 
        DB::table('hotel_reviews')->insert(['rating'=>rand(3.5,5),
        'product_id'=>$i,
        'user_id'=>1]);
     }
    }
}
