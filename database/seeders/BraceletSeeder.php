<?php

namespace Database\Seeders;

use App\Domain\Child\Models\Bracelet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BraceletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bracelet::create([
            'id'            =>  1,
            'child_name'    =>  'test child',
            'code'          =>  'pb-01',
            'user_id'       =>  1,
        ]);
    }
}
