<?php

namespace lsapp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use lsapp\Post;

class PostController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //**Options *//
        //$posts = Post::all();
        //return Post::where('title', Post Two'); -> specific result
        //$posts = DB::select('SELECT * FROM posts'); -> Non-eloquent SQL query

        //return index
        $posts = Post::orderby('created_at', 'desc')->paginate(10);
        // $posts = Post::orderby('title', 'desc')->get();
        return view("posts.index")->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //creating a post
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
            $this->validate($request, [
                'title'=>'required',
                'body'=>'required',
                // nullable == optional
                // apache max upload 2mb
                'cover_image' => 'image|nullable|max:1999'
            ]);
            // Handle File Upload
            if($request->hasFile('cover_image')) {
                // Get filename with extension 
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
               // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
              // Upload Image
                $path = $request->file('cover_image')->    storeAs('public/cover_images', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }
            // create Post
            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->cover_image = $fileNameToStore;
            $post->save();
            return redirect('/posts')->with('success', 'Post created');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return post id
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //forces url access control
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unathorized Access, not allowed...');

        }      
         return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
    
        $this->validate($request, [
        'title'=>'required',
        'body'=>'required',
        // nullable == optional
        // apache max upload 2mb
        'cover_image' => 'image|nullable|max:1999'
    ]);
    // Handle File Upload
    if($request->hasFile('cover_image')) {
        // Get filename with extension 
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
       // Get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
      // Upload Image
        $path = $request->file('cover_image')->    storeAs('public/cover_images', $fileNameToStore);
    }
    // create Post
    $post = Post::find($id);
    $post->title = $request->input('title');
    $post->body = $request->input('body');
        if($request->hasFile('cover_image')){

        $post->cover_image = $fileNameToStore;
    }
    $post->save();
    return redirect('/posts')->with('success', 'Post Updated!');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        //forces url access control
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unathorized Access, not allowed...');

        }      

        if($post->cover_image != 'noimage.jpg'){
            //delete image

            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Successfully Deleted');
    }

    
}
