<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('profiles')->truncate();

        DB::table('profiles')->insert([
            'user_id' => 1,
            'birthday' => '1990-10-01',
            'gender' => 'male',
            'socialid' => '1234567891',
            'address' => 'Prishtina, Kosovo',
            'biography' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique inventore dolore voluptatibus, placeat explicabo, sit facere magnam. Id nisi cupiditate eum, adipisci minus culpa praesentium molestiae! Ab quis provident, minima.',
            'skills' => 'programming, design, project management',
            'phone' => '123 123 123',
            'website' => 'http://localhost:8000',
            'github_username' => 'altinukshini',
            'facebook_username' => 'altinukshini',
            'twitter_username' => 'altinukshini',
            'linkedin_username' => 'altinukshini',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
