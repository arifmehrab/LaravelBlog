<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\comment;
use DB;
class commentController extends Controller
{
    public function commentStore(Request $request, $post_id){
        if(Auth::user()){
        	// comment data save
        	 $comment = new comment();
        	 $comment->post_id = $post_id;
        	 $comment->user_id = Auth::user()->id;
        	 $comment->comment = $request->comment;
        	 $comment->save();
        	 // Redirect
        	return redirect()->back()->with('success', 'Comment Added Successfully');
        } else{
        	$validation = $request->validate([
        		'name' => 'required',
        		'email' => 'required|email|unique:users'
        	]);
        	// user data save
        	$user = new User();
        	$user->name = $request->name;
        	$user->email = $request->email;
        	$user->password = 'null';
            $user->save();
            $user_id = $user->id;
             // comment data save
        	 $comment = new comment();
        	 $comment->post_id = $post_id;
        	 $comment->user_id = $user_id;
        	 $comment->comment = $request->comment;
        	 $comment->save();
        	// Redirect
        	return redirect()->back()->with('success', 'Comment Added Successfully');
        }
    }
}
