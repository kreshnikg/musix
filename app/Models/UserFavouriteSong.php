<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavouriteSong extends Model
{
    use HasFactory;

    protected $table = 'user_favourite_song';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'song_id'
    ];
}
