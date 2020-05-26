<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\comment;

class commentController extends Controller
{
    public function index(){
    	$comments = comment::latest()->get();
    	return view('layouts.Backend.Admin.comments.view_comments', compact('comments'));
    }
    public function destroy($id){
        $comment = comment::find($id);
        $comment->delete();
        return redirect()->route('admin.comment.index')->with('success', 'Your Comment Delated Successfully');
    }
}
