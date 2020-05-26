<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class favouriteController extends Controller
{
    public function index(){
    	$user = Auth::user();
    	$posts = $user->fevouritePost()->get();
    	return view('layouts.Backend.Admin.post.favourite_post_list', compact('posts'));
    }
}
