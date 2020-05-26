<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
   // admin dashboard //
    public function index(){
    	return view('layouts.Backend.Admin.dashboard');
    }
}
