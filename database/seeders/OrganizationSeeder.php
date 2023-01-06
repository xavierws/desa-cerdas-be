<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_types')->insert([
            ['id' => 1, 'name' => 'paten'],
            ['id' => 2, 'name' => 'nonpaten'],
        ]);
    }
}
