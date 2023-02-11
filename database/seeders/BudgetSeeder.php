<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budget_categories')->insert([
            ['id' => 1, 'name' => 'pendapatan'],
            ['id' => 2, 'name' => 'belanja'],
            ['id' => 3, 'name' => 'pembiayaan'],
        ]);
    }
}
