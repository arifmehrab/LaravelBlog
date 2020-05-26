<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;
use App\Models\tag;
use Auth;
use Illuminate\Support\str;
use Notification;
use App\Notifications\newAuthorPost;
use App\Models\User;
class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('layouts.Backend.Author.post.post_view', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = category::latest()->get();
        $data['tags'] = tag::latest()->get();
        return view('layouts.Backend.Author.post.post_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validation
        $validation = $request->validate([
            'title'      => 'required',
            'image'      => 'required|mimes:jpg,jpeg,png',
            'categories' => 'required',
            'tages'       => 'required'
        ]);
        // Image Upload
        if($request->file('image')) {
           $image = $request->file('image');
           $imageName = date('d-m-Y').'.'.uniqid().'.'.$image->getClientOriginalName();
           $imagePath = public_path('/Backend/assets/images/posts/');
           $image->move($imagePath, $imageName);
       }
        $post = new post();
        $post->user_id = Auth::user()->id;
        $post->title   = $request->title;
        $post->slug    = str::slug($request->title,'-');
        $post->image   = $imageName;
        $post->body    = $request->body;
        $post->view_count = '0';
        if(isset($request->publish)) {
            $post->status = '1';
        } else{
            $post->status = '0';
        }
        $post->is_approved = '0';
        $post->date = date('Y-m-d');
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tages);
        // Mail Notification For Admin 
        $users = User::where('role_id', 1)->get();
        Notification::send($users, new newAuthorPost($post));
        // Redirect
       return redirect()->route('author.post.index')->with('success', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);
        if($post->user_id != Auth::user()->id) {

            return redirect()->back()->with('error', 'Your Are Not Permision To Access This Post!');
        }
        return view('layouts.Backend.Author.post.post_show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
       $data['post'] = post::find($id);
       if($data['post']->user_id != Auth::user()->id) {

            return redirect()->back()->with('error', 'Your Are Not Permision To Access This Post!');
        }
       $data['categories'] = category::latest()->get();
       $data['tags'] = tag::latest()->get();
       return view('layouts.Backend.Author.post.post_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = post::find($id);
         // Image Update
        if($request->file('image')) {
           $image = $request->file('image');
           @unlink(public_path('/Backend/assets/images/posts/'.$post->image));
           $imageName = date('d-m-Y').'.'.uniqid().'.'.$image->getClientOriginalName();
           $imagePath = public_path('/Backend/assets/images/posts/');
           $image->move($imagePath, $imageName);
           $post->image   = $imageName;
       }
        $post->user_id = Auth::user()->id;
        $post->title   = $request->title;
        $post->slug    = str::slug($request->title,'-');
        $post->body    = $request->body;
        $post->view_count = '0';
        if(isset($request->publish)) {
            $post->status = '1';
        } else{
            $post->status = '0';
        }
        $post->is_approved = '0';
        $post->date = date('Y-m-d');
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tages);
        // Redirect
       return redirect()->route('author.post.index')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
        if($post->user_id != Auth::user()->id) {

            return redirect()->back()->with('error', 'Your Are Not Permision To Access This Post!');
        }
        @unlink(public_path('/Backend/assets/images/posts/'. $post->image));
       $post->categories()->detach();
       $post->tags()->detach();
       $post->delete();
        // Redirect
       return redirect()->route('author.post.index')->with('success', 'Post Delated Successfully');
    }
}
