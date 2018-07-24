<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\	Carbon;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('blogs')->insert([
            'title' => str_random(10),
            'discription' => str_random(100),
            'author_id' => random_int(1, 3),
             'accept'=>0,
             'created_at'=>Carbon::parse('2000-01-01'),
             'updated_at'=>Carbon::parse('2000-01-01'),
        ]);
    }
}
