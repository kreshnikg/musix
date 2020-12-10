<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if user subscribed
     *
     * @return mixed
     */
    public function subscribed()
    {
        return Subscription::where('user_id', $this->user_id)->valid()->exists();
    }

    public function subscribe()
    {
        $subscription = new Subscription;
        $subscription->user_id = $this->user_id;
        $subscription->ends_at = Carbon::now()->addMonth();
        $subscription->save();
    }

    public function addFavourite($song)
    {
        UserFavouriteSong::create([
            'user_id' => $this->user_id,
            'song_id' => $song->song_id
        ]);
    }

    public function removeFavourite($song)
    {
        UserFavouriteSong::where('user_id', $this->user_id)
            ->where('song_id', $song->song_id)->delete();
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'role_id', 'role_id');
    }

    public function favouriteSongs()
    {
        return $this->hasManyThrough(
            'App\Models\Song',
            'App\Models\UserFavouriteSong',
            'user_id',
            'song_id',
            'user_id',
            'song_id'
        );
    }
}
