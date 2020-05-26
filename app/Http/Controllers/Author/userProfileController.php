<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class userProfileController extends Controller
{
    public function index(){
    	$user = User::find(Auth::user()->id);
    	return view('layouts.Backend.Author.users.user_profile', compact('user'));
    }
    // Profile Update //

    public function updateProfile(Request $request) {

    	// validation
    	$validation = $request->validate([
    		'name' => 'required',
    		'email' => 'required',
    		'image' => 'image|mimes:jpg,png,jpeg'
    	]);

    	// update profile
    	$userProfile = User::find(Auth::user()->id);

        // image
    	if($request->file('image')) {
           $image = $request->file('image');
           @unlink(public_path('/Backend/assets/images/profile/'.$userProfile->profile));
           $imageName = date('d-m-Y').'.'.uniqid().'.'.$image->getClientOriginalName();
           $imagePath = public_path('/Backend/assets/images/profile/');
           $image->move($imagePath, $imageName);
           $userProfile->profile = $imageName;
    	}
    	// update
    	$userProfile->name = $request->name;
    	$userProfile->email = $request->email;
    	$userProfile->address = $request->address;
    	$userProfile->about = $request->about;
        $userProfile->save();

        // Redirect
        return redirect()->back()->with('success','Your Profile Updated SuccessFully');
    }
    // Password Change //
    public function passwordUpdate(Request $request){

         // validation 
            $validation = $request->validate([
            	'current_password' => 'required',
            	'password' => 'required'
            ]);

         if(Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->current_password])) {
            // Confirmation
            $validation = $request->validate([
            	'password' => 'required|confirmed'
            ]);
            // update
            $changePass = User::find(Auth::user()->id);
            $changePass->password = Hash::make($request->password);
            $changePass->save();
            // Redirect
            return redirect()->back()->with('success','Your Password Update Successfully');
         } else{
         	return redirect()->back()->with('error','Your Current Password Not Match');
         }
    }
}
