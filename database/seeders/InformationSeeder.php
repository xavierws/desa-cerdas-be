<?php

namespace Database\Seeders;

use App\Models\VillageInformation;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VillageInformation::create([
            'vision' => 'Visi',
            'mission' => 'Misi',
            'image' => 'https://desa-tambakrejo.com',
            'url' => 'https://desa-tambakrejo.com',
        ]);
    }
}
