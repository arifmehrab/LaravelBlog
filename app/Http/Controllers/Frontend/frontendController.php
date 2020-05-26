<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\post;

class frontendController extends Controller
{
    // view Front Page
    public function index(){
    	$data['categories'] = category::all();
    	$data['posts'] = post::where('is_approved', 1)->where('status', 1)->latest()->take(9)->get();
        return view('layouts.Frontend.index', $data);
    }
    public function contact(){
    	return view('layouts.Frontend.contact');
    }
}
