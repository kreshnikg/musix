<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';

    protected $primaryKey = 'subscription_id';

    public function scopeValid($query)
    {
        return $query->where('ends_at', '>', Carbon::now());
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }
}
