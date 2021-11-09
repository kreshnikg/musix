<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $table = 'playlist';

    protected $primaryKey = 'playlist_id';

    public function playlistSongs()
    {
        return $this->hasMany(
            'App\Models\PlaylistSong',
            'playlist_id',
            'playlist_id'
        );
    }

    public function songs()
    {
        return $this->hasManyThrough(
            'App\Models\Song',
            'App\Models\PlaylistSong',
            'playlist_id',
            'song_id',
            'playlist_id',
            'song_id'
        );
    }
}
