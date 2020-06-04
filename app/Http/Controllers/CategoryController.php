<?php

namespace App\Http\Controllers;
use Session;
use App\Category;
use Gate;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Category::all();
        return view('admin.categories.index', compact("categories"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(Gate::denies('admin_only')){
            Session::flash('info', 'Only admin is allowed to create a category');
            return redirect()->route('home');
        }
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $this->validate($request,[

            'name' => 'required|max:255',

            ]);
           $category = new Category;
           $category->name = $request->name;
           $category->save();
           Session::flash('success', 'A new category is created successfully');

           return redirect()->route('categories');
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
        if(Gate::denies('admin_only')){
            Session::flash('info', 'Only admin is allowed to edit the category');
            return redirect()->route('categories');
        }
        $category = Category::find($id);
        return view('admin.categories.edit', compact("category"));
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
         $category = Category::find($id);
        $this->validate($request,[

            'name' => 'required|max:255',

            ]);
        
           $category->name = $request->name;
           $category->save();
           Session::flash('success', 'Category is updated successfully');
           return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('admin_only')){
            Session::flash('info', 'Only admin is allowed to delete a category');
            return redirect()->route('categories');
        }
         $category = Category::find($id);
         $category->delete();
         Session::flash('warning', 'Category is deleted successfully');
          return redirect()->route('categories');

    }
}
