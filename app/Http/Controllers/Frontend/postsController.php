<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;
use App\Models\tag;

class postsController extends Controller
{
    public function viewAllPost(){
    	$posts = post::where('is_approved', 1)->where('status', 1)->latest()->paginate(6);
    	return view('layouts.Frontend.posts', compact('posts'));
    }

    public function categoryByPost($slug){
        $category = category::where('slug', $slug)->first();
        $posts = $category->posts()->where('is_approved', 1)->where('status', 1)->get();
        return view('layouts.Frontend.category_post', compact('category', 'posts'));
    }
    public function tagByPost($slug){
    	$tag = tag::where('slug', $slug)->first();
        $posts = $tag->posts()->where('is_approved',1)->where('status', 1)->get();
    	return view('layouts.Frontend.tag_post', compact('tag', 'posts'));
    }
    public function searchPost(Request $request){
        $search = $request->search;
        $resuitles = post::where('title','LIKE', "%$search%")->where('is_approved', 1)->where('status', 1)->get();
        return view('layouts.Frontend.search_resuit', compact('search', 'resuitles'));

    }
}
