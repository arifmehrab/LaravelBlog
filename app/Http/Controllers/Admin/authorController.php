<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;
use App\Models\comment;

class authorController extends Controller
{
    public function index(){
    	$authors = User::where('role_id', 2)->get();
    	return view('layouts.Backend.Admin.users.authors', compact('authors'));
    }
    public function destroy($id){
    	 $user = User::find($id);
         post::where('user_id', $user->id)->delete();
    	 comment::where('user_id', $user->id)->delete();
         $user->delete();
    	 return redirect()->back()->with('success', 'Author Deleted Successfully');
    }
}
