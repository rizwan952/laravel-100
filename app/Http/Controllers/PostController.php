<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Session;
use Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        if(Gate::denies('subs_only')){

        $categories = Category::all();
        if ($categories->count() == 0) {
            Session::flash('info', 'You must have some categories before attempting to create a post');
            return redirect()->back();
            }        
        return view('admin.posts.create', compact('categories'));
        }else{

       

        Session::flash('info', 'Editors and Admins are allowed to create a post');
        return redirect()->route('home');
        }
    
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

            'title' => 'required|max:255',
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required'


            ]);
        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' =>'uploads/posts/' . $featured_new_name,
            'category_id'=>$request ->category_id
            ]);
        Session::flash('success', 'Post created successfully');
        return redirect()->route('posts');

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
        if(Gate::denies('subs_only')){


        $post = Post::find($id);
        $categories = Category::all();
         return view('admin.posts.edit', compact('post', 'categories'));
     }else{

       

        Session::flash('info', 'Editors and Admins are allowed to edit the post');
        return redirect()->route('home');
        }

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


            $this->validate($request,[

            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required'


            ]);
            $post = Post::find($id);
            if ($request->hasFile('featured')) {
                 
                 $featured = $request->featured;
                 $featured_new_name = time().$featured->getClientOriginalName();
                 $featured->move('uploads/posts', $featured_new_name);
                 $post->featured ='uploads/posts/' . $featured_new_name;
            }
       
       
            $post->title = $request->title;
            $post->content = $request->content;             
            $post->category_id = $request ->category_id;
            $post->save();

        
        Session::flash('success', 'Post updated successfully');
        return redirect()->route('posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if(Gate::denies('subs_only')){

         $post = Post::find($id);
         $post->delete();
         Session::flash('info', 'Post deleted successfully');
         return redirect()->route('posts');

        } else{

       

        Session::flash('info', 'Editors and Admins are allowed to create a post');
        return redirect()->route('home');
        }
    }
}
