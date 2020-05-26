<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function categories(){
    	return $this->belongsToMany(category::class);
    }
    public function tags(){
    	return $this->belongsToMany(tag::class);
    }
    public function fevouriteToUser(){
    	return $this->belongsToMany(User::class);
    }
    public function comments(){
        return $this->hasMany(comment::class, 'post_id', 'id');
    }
}
