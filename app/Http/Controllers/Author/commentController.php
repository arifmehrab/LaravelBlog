<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\comment;
class commentController extends Controller
{
     public function index(){
    	$posts = Auth::user()->posts()->get();
    	return view('layouts.Backend.Author.comments.view_comments', compact('posts'));
    }
    public function destroy($id){
    	$user = Auth::user()->id;
        $comment = comment::find($id);
        if($comment->post->user->id == $user) {
        	$comment->delete();
        	return redirect()->route('author.comment.index')->with('success', 'Comment Delated Successfully');
        }
        
    }
}
