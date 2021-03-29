<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert(['locale'=>'Українська','prefix'=>'UA']);
        DB::table('languages')->insert(['locale'=>'English','prefix'=>'EN']);
        DB::table('languages')->insert(['locale'=>'Русский','prefix'=>'RU']);
    }
}
