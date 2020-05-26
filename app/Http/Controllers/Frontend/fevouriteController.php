<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class fevouriteController extends Controller
{
    public function fevouriteList($id){
    	$user = Auth::user();
        $isPavourite = $user->fevouritePost()->where('post_id', $id)->count();
        if($isPavourite == '0'){
           $user->fevouritePost()->attach($id);
           return redirect()->back()->with('success','This post Added Your Favourite List');
        } else{
          $user->fevouritePost()->detach($id);
          return redirect()->back()->with('error','This post Remove Your Favourite List');
        }
    }
}
