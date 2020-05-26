<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\comment;
use App\Models\User;
use App\Models\tag;
use App\Models\category;
use App\Models\subscribe;

class dashboardController extends Controller
{
    // admin dashboard //
    public function index(){
    	$data['posts']       = post::all();
    	$data['activAuthor'] = User::where('role_id', 2)
    	                             ->withCount('posts')
    	                             ->withCount('fevouritePost')
    	                             ->withCount('comments')
    	                             ->take(4)->get();
    	$data['newAuthor']   = User::where('role_id', 2)
    	                             ->whereDate('created_at', today())->count();
    	$data['user']        = User::where('role_id', 2)->count();
    	$data['category']    = category::all()->count();
    	$data['tag']         = tag::all()->count();
    	$data['popularPost'] = post::withCount('fevouriteToUser')
    	                            ->withCount('comments')
    	                            ->orderBy('view_count', 'desc')
    	                            ->take(5)->get();
    	$data['pendingPost'] = post::where('is_approved', 0)->count();
    	$data['allView']     = post::sum('view_count');
        $data['subscribers'] = subscribe::all();
    	return view('layouts.Backend.Admin.dashboard', $data);
    }
}
