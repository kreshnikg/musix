<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongMonthlyStatistics extends Model
{
    use HasFactory;

    protected $table = 'song_monthly_statistics';

    protected $primaryKey = 'id';
}
