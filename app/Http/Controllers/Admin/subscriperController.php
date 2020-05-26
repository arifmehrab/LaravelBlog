<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Mail;
use App\Mail\testMail;
class subscriperController extends Controller
{
    public function index(){
        $subscribers = subscribe::all();
        return view('layouts.Backend.Admin.users.subscriber', compact('subscribers'));
    }
    public function store(Request $request) {

        $sub = new subscribe();
        $sub->email = $request->email;
        $sub->save();
        return redirect()->back()->with('success', 'Your Mail Send Successfully');
    }
    public function destroy($id){
        $sub = subscribe::find($id);
        $sub->delete();
        return redirect()->route('admin.subscriber.index')->with('success', 'Subscriber Deleted Successfully');
    }
}
