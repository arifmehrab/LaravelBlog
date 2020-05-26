<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function posts(){
    	return $this->belongsToMany(post::class);
    }
}
