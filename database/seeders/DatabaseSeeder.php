<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        $user = new \App\Models\User();
        $user->name = 'John DOE';
        $user->email = 'john.doe@email.com';
        $user->password = bcrypt('secret');
        $user->save();
    }
}
