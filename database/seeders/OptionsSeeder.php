<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Option::create([
            'image' => 'main.png',
            'key' => 'AIzaSyBSNQLhR2yEuFkYAoU_q4sXlvsd_8lOMBA',
            'foundation' => '',
            'history' => '',
        ]);
    }
}
