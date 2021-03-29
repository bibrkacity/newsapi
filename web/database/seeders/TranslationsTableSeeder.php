<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class TranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translations')->insert(['language_id'=>2,'title'=>'Start Tag','translatable_id'=>1,'translatable_type'=>'App\Models\Tag']);
    }
}
