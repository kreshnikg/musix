<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'artist';

    protected $primaryKey = 'artist_id';

    public function genres()
    {
        return $this->hasManyThrough(
            'App\Models\Genre',
            'App\Models\ArtistGenre',
            'artist_id',
            'genre_id',
            'artist_id',
            'genre_id'
        );
    }

    public function songs()
    {
        return $this->hasManyThrough(
            'App\Models\Song',
            'App\Models\SongArtist',
            'artist_id',
            'song_id',
            'artist_id',
            'song_id'
        );
    }
}
