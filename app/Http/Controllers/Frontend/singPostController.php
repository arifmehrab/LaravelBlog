<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use Session;
class singPostController extends Controller
{
    public function postSingleView($slug){
        $singlePost = post::where('slug', $slug)->first();
        $postKey = 'blog_'.$singlePost->id;
        if(!session::has($postKey)) {
        	$singlePost->increment('view_count');
            session::put($postKey, 1);
        }
        $randomPost = post::where('is_approved', 1)->where('status', 1)->take(3)->get();
        return view('layouts.Frontend.post_details', compact('singlePost','randomPost' ));
    }
}
