<?php

namespace App\Http\Controllers;

use App\Post;
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
      $posts = Post::where('user_id', '=', auth()->user()->id )
                    ->get();
      return view('show-posts', compact('var-in-view','posts'));             //sending variable posts to view


      // $posts = Post::all();
      // return $posts;                                                   //returns in json format
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('create-posts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        ////////////////  Form Validation ////////////////
        $request->validate([
          'title' => 'required|unique:posts|max:255',
          'content' => 'required',
          'author' => 'required',
          'image' => 'mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        ////////////////  File Storage ////////////////
        if($request->hasFile('image')){
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.$fileExt;
            // $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);
        }


        $post = new Post();
        $post->title = $request->title; //1st title = model || 2nd title = <input name="title">
        $post->content = $request->content;
        $post->author = $request->author;
        $category = ($request->category) ? $request->category : 'General';
        $post->category = $category;
        if($request->hasFile('image')){
            $post->post_img = $fileNameToStore;
            // $post->post_img = $request->file('image')->store('image');  
        }
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->back()->with('message', 'IT WORKS!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // return $post;
        return view("update-posts", compact ('','post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //return view("update-posts", compact ('','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // return $post;
        // return $request;
        $this->validate(request(), [
          'title'=>'required',
          'content'=>'required',
          'author'=>'required',
          'category'=>'required',
          'image' => 'mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        if($request->hasFile('image')){
            $fileNameExt1 = $request->file('image')->getClientOriginalName();
            $fileName1 = pathinfo($fileNameExt1, PATHINFO_FILENAME);
            $fileExt1 = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore1 = $fileName1.'_'.time().'.'.$fileExt1;
            $pathToStore1 = $request->file('image')->storeAs('public/images',$fileNameToStore1);
        }

        $update_post = $post;
        $update_post->title = $request->title;
        $update_post->content = $request->content;
        $update_post->author = $request->author;
        $update_post->category = ($request->category) ? $request->category : "General";
        if($request->hasFile('image') && $update_post->post_img !== $fileNameToStore1){
            $update_post->post_img = $fileNameToStore1;
        }
        $update_post->save();

        return redirect("posts/$post->id")->with('message','POST SUCCESSFULLY UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // return $post;
        $post->delete();
        return redirect("posts")->with('message', 'Deleted');
    }

}
