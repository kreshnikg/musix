<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistSong extends Model
{
    use HasFactory;

    protected $table = 'playlist_song';

    protected $primaryKey = 'id';

    public function song()
    {
        return $this->hasOne(
            'App\Models\Song',
            'song_id',
            'song_id'
        );
    }
}
