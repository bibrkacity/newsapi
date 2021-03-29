<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(['created_at'=>date('Y-m-d H:i:s')]);
    }
}
