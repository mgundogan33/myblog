<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\Role::truncate();
         \App\Models\Category::truncate();
        \App\Models\Post::truncate();
        Schema::enableForeignKeyConstraints();

         \App\Models\Role::factory(1)->create();
         \App\Models\User::factory(10)->create();

         \App\Models\Category::factory(10)->create();
         \App\Models\Post::factory(100)->create();

    }
}
