<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArtistTableSeeder extends Seeder
{
    private $artists = [
        [
            "full_name" => "Dua Lipa",
            "image" => "/artists/",
            "genres" => [1]
        ], [
            "full_name" => "Rita Ora",
            "image" => "/artists/",
            "genres" => [1]
        ], [
            "full_name" => "Bebe Rexha",
            "image" => "/artists/",
            "genres" => [1]
        ], [
            "full_name" => "Eminem",
            "image" => "/artists/",
            "genres" => [2, 13]
        ], [
            "full_name" => "GASHI",
            "image" => "/artists/",
            "genres" => [1, 13]
        ], [
            "full_name" => "Post Malone",
            "image" => "/artists/",
            "genres" => [13]
        ], [
            "full_name" => "The Weeknd",
            "image" => "/artists/",
            "genres" => [1, 7]
        ], [
            "full_name" => "Ed Sheeran",
            "image" => "/artists/",
            "genres" => [1]
        ], [
            "full_name" => "Metallica",
            "image" => "/artists/",
            "genres" => [3, 4]
        ], [
            "full_name" => "Avicii",
            "image" => "/artists/",
            "genres" => [1, 14]
        ], [
            "full_name" => "OneRepublic",
            "image" => "/artists/",
            "genres" => [1, 4, 14]
        ], [
            "full_name" => "Imagine Dragons",
            "image" => "/artists/",
            "genres" => [4]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->artists as $artist) {
            $art = \App\Models\Artist::create([
                "full_name" => $artist["full_name"],
                "href" => toURL($artist["full_name"]),
                "image" => $artist["image"]
            ]);

            foreach ($artist["genres"] as $genre) {
                \App\Models\ArtistGenre::create([
                    "artist_id" => $art->artist_id,
                    "genre_id" => $genre
                ]);
            }
        }
    }
}
