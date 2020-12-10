<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = 'song';

    protected $primaryKey = 'song_id';

    public function scopeFavourited($query, $userId)
    {
        return $query->selectRaw(
            '*, EXISTS(SELECT * FROM user_favourite_song WHERE user_id = ? AND song_id = song.song_id) as is_favourited',
            [$userId]
        );
    }

    public function artists()
    {
        return $this->hasManyThrough(
            'App\Models\Artist',
            'App\Models\SongArtist',
            'song_id',
            'artist_id',
            'song_id',
            'artist_id'
        );
    }

    public function genres()
    {
        return $this->hasManyThrough(
            'App\Models\Genre',
            'App\Models\SongGenre',
            'song_id',
            'genre_id',
            'song_id',
            'genre_id'
        );
    }

    public function usersFavourite()
    {
        return $this->hasMany(
            'App\Models\UserFavouriteSong',
            'song_id',
            'song_id'
        );
    }
}
