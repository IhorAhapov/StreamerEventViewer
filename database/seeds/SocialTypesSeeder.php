<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('social_types')->truncate();

        $types = [
            ['id' => 1, 'name' => 'twitch']
        ];

        DB::table('social_types')->insert($types);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
