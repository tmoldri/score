<?php

use App\Card;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate all tables before seeding
        DB::table('users')->truncate();
        DB::table('cards')->truncate();
        DB::table('elements')->truncate();
        DB::table('element_user')->truncate();
        DB::table('card_user')->truncate();

        //seed main test user
        $user = new User;
        $user->name = 'John Doe';
        $user->email = 'JohnDoe@test.com';
        $user->password = bcrypt('password');
        $user->save();

        $card = new Card;
        $card->title = 'Sleeping';
        $card->save();

        $card->elements()->createMany([
            [
                'title' => 'Slept more than 10 hours straight',
                'points' => 10
            ],
            [
                'title' => 'Slept more than 20 hours straight',
                'points' => 20
            ],
            [
                'title' => 'Slept during earthquake without waking up',
                'points' => 30
            ],
        ]);

        $card->total_points = $card->elements()->sum('points');
        $card->save();

        $card = new Card;
        $card->title = 'Running';
        $card->save();

        $card->elements()->createMany([
            [
                'title' => 'Ran more than 1 hours straight',
                'points' => 10
            ],
            [
                'title' => 'Ran more than 5 hours straight',
                'points' => 20
            ],
            [
                'title' => 'Ran more than 10 hours straight',
                'points' => 40
            ],
            [
                'title' => 'Ran more than 20 hours straight',
                'points' => 80
            ],
        ]);

        $card->total_points = $card->elements()->sum('points');
        $card->save();

        $card = new Card;
        $card->title = 'Bonfire';
        $card->save();

        $card->elements()->createMany([
        	[
        		'title' => 'Have jumped over bonfire',
        		'points' => 10
        	],
            [
                'title' => 'Have started a fire without matches',
                'points' => 30
            ],
            [
                'title' => 'Have roasted marshmellows on bonfire',
                'points' => 40
            ],
        ]);

        $card->total_points = $card->elements()->sum('points');
        $card->save();
    }
}
