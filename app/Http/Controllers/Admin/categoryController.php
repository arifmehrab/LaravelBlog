<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tag;
use App\Models\category;
use Illuminate\Support\str;
class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::latest()->get();
        return view('layouts.Backend.Admin.category.category_view', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.Backend.Admin.category.category_create');
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
            'category' => 'required',
            'image'    => 'required|mimes:jpg,jpeg,png'
        ]);
        // Image Upload
        if($request->file('image')) {
           $image = $request->file('image');
           $imageName = date('d-m-Y').'.'.uniqid().'.'.$image->getClientOriginalName();
           $imagePath = public_path('/Backend/assets/images/categories/');
           $image->move($imagePath, $imageName);
       }
       // Insert category
        $category = new category();
        $category->name = $request->category;
        $category->slug = str::slug($request->category,'-');
        $category->image = $imageName;
        $category->save();
        // redirect
        return redirect()->route('admin.category.index')->with('success','category Added Successfully');

        
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
        $category = category::find($id);
        return view('layouts.Backend.Admin.category.category_edit', compact('category'));
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
        // Update
        $categoryUpdate = category::find($id);
        // Image Upload
        if($request->file('image')) {
           $image = $request->file('image');
           @unlink(public_path('/Backend/assets/images/categories/'. $categoryUpdate->image));
           $imageName = date('d-m-Y').'.'.uniqid().'.'.$image->getClientOriginalName();
           $imagePath = public_path('/Backend/assets/images/categories/');
           $image->move($imagePath, $imageName);
           $categoryUpdate->image = $imageName;
       }
        $categoryUpdate->name = $request->category;
        $categoryUpdate->slug = str::slug($request->category,'-');
        $categoryUpdate->save();
        // Redirect
        return redirect()->route('admin.category.index')->with('success', 'Tag Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = category::find($id);
        @unlink(public_path('/Backend/assets/images/categories/'.$category->image));
        $category->delete();
        // Redirect
        return redirect()->route('admin.category.index')->with('success','category Delated Successfully');
    }
}
