<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongGenre extends Model
{
    use HasFactory;

    protected $table = 'song_genre';

    protected $primaryKey = 'id';

    protected $fillable = [
        'song_id',
        'genre_id'
    ];
}
