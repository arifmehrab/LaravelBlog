<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class favouriteController extends Controller
{
    public function index(){
    	$user = Auth::user();
    	$posts = $user->fevouritePost;
    	return view('layouts.Backend.Author.post.favourite_post_list', compact('posts'));
    }
}
