<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = 'song';

    protected $primaryKey = 'song_id';

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
}
