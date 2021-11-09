<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    private $genres = [
        'Pop', // 1
        'Hip Hop', // 2
        'Metal', // 3
        'Rock', // 4
        'Electronic', // 5
        'Jazz',// 6
        'R&B',// 7
        'Classical',// 8
        'Latin',// 9
        'Country',// 10
        'Blues',// 11
        'Techno',// 12
        'Rap',// 13
        'Dance'// 14
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->genres as $genre) {
            \App\Models\Genre::create([
                "title" => $genre,
            ]);
        }
    }
}
