<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'points',
    ];

    /**
     * Element belongs to a Card
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get users that have checked this element
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'element_user','element_id','user_id')->withTimestamps();
    }

}
