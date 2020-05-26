<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public function post(){
    	return $this->belongsTo(post::class, 'post_id', 'id');
    }
    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
