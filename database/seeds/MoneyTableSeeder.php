<?php

use Illuminate\Database\Seeder;

class MoneyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Money::class, 20)->create();
    }
}
