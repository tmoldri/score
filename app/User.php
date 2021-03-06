<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user cards
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class)->withPivot(['total_points']);
    }

    /**
     * Get user elements
     */
    public function elements()
    {
        return $this->belongsToMany(Element::class);
    }
}
