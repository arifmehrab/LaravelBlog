<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tag;
use Illuminate\Support\str;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tages = tag::latest()->get();
        return view('layouts.Backend.Admin.tag.tag_view', compact('tages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.Backend.Admin.tag.tag_create');
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
            'tag' => 'required'
        ]);
        // Insert Tag
        $tag = new tag();
        $tag->name = $request->tag;
        $tag->slug = str::slug($request->tag,'-');
        $tag->save();
        // redirect
        return redirect()->route('admin.tag.index')->with('success','Tag Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $tagEdit = tag::find($id);
        return view('layouts.Backend.Admin.tag.tag_edit', compact('tagEdit'));
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
        $tagUpdate = tag::find($id);
        $tagUpdate->name = $request->tag;
        $tagUpdate->slug = str::slug($request->tag,'-');
        $tagUpdate->save();
        // Redirect
        return redirect()->route('admin.tag.index')->with('success', 'Tag Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tagDelete = tag::find($id);
        $tagDelete->delete();
        // Redirect
        return redirect()->route('admin.tag.index')->with('success','Tag Delated Successfully');
    }
}
