<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //GD11
        DB::table('users')->insert([
            'name' => 'PanduWidiatmika',
            'email' => 'XXXXX@students.uajy.ac.id',
            'password' => '$2a$12$fSjrQwV419lNsFWzd6sHcOqs0eAIf54negQ2IJwfew9QUYBYz1Lwq',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
