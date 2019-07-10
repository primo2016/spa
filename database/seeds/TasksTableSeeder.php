<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'urlimage' => 'public/url1',
            'descripcion' => 'Descripción 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'urlimage' => 'public/url2',
            'descripcion' => 'Descripción 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'urlimage' => 'public/url3',
            'descripcion' => 'Descripción 3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
