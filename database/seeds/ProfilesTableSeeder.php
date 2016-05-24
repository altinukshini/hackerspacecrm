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
            'birthday' => '2016-01-01',
            'gender' => 'male',
            'socialid' => '1234567891',
            'address' => 'Prishtina, Kosovo',
            'biography' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique inventore dolore voluptatibus, placeat explicabo, sit facere magnam. Id nisi cupiditate eum, adipisci minus culpa praesentium molestiae! Ab quis provident, minima. <br> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique inventore dolore voluptatibus, placeat explicabo, sit facere magnam. Id nisi cupiditate eum, adipisci minus culpa praesentium molestiae! Ab quis provident, minima. <br> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique inventore dolore voluptatibus, placeat explicabo, sit facere magnam. Id nisi cupiditate eum, adipisci minus culpa praesentium molestiae! Ab quis provident, minima. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique inventore dolore voluptatibus, placeat explicabo, sit facere magnam. Id nisi cupiditate eum, adipisci minus culpa praesentium molestiae! Ab quis provident, minima. <br>',
            'skills' => 'programming, design, project management',
            'phone' => '+1 555 555 555',
            'website' => 'http://www.example.com',
            'github_username' => 'admin',
            'facebook_username' => 'admin',
            'twitter_username' => 'admin',
            'linkedin_username' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
