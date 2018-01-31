<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'total_points',
    ];

    /**
     * Get card elements
     */
    public function elements()
    {
        return $this->hasMany(Element::class);
    }

    /**
     * Get card users
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['total_points']);
    }

    /**
     * Get card current user
     */
    public function current_user()
    {
        return $this->belongsToMany(User::class)->withPivot(['total_points'])->wherePivot('user_id',Auth::id());
    }

    /**
     * Get total points for current user
     */
    public function getUserPointsAttribute()
    {
        if (!$this->current_user->isEmpty()) return $this->current_user->first()->pivot->total_points;
        else return 0;
    }
}
