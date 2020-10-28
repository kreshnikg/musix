<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistGenre extends Model
{
    use HasFactory;

    protected $table = 'artist_genre';

    protected $primaryKey = 'id';

    protected $fillable = [
        'artist_id',
        'genre_id'
    ];
}
