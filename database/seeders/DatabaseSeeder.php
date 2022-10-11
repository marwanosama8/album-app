<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Album::factory(10)->create();
        $faker = Faker::create();

        $data = Album::find(1);
        $url = 'https://images.all-free-download.com/images/graphiclarge/ford_fairlane_zb_500_516881.jpg';
        for ($i = 0; $i < 5; $i++) {
            // $data->addMediaFromUrl($url)->toMediaCollection();
            $data->addMediaFromUrl($url)->usingName($faker->name())->toMediaCollection();
        }
        // foreach ($data as $value) {
        // }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
