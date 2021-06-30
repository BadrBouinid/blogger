<?php

namespace App\Http\Controllers;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Auth;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     * 
     */
 


    public function index()
    {
      
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('posts.add');
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
           'title'=>'required',
           'body'=>'required|max:1000',
           'file'=>'required'

       ]);
       $file=$request->file('file');
       $name=$file->getClientOriginalName();
       $file->move(public_path().'/images/',$name);
       $post=new Post();
       $post->title=$request->titre;
       $post->body=$request->body;
       $post->file=$name;
       $post->user_id=Auth::user()->id;
       $post->category_id=1;
       $post->save();
       return redirect('/')->with('success','Article ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post=Post::findOrFail($id);
       $lastAddedPosts=Post::orderBy('created_at','DESC')->take(3)->get();
       return view('posts.show',compact('post','lastAddedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
       return view('posts.edit',compact('post'));
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
        $post=Post::findOrFail($id);
        if($request->hasFile('file')){

            $file=$request->file('file');
            $name=$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);
            $post->file=$name;
        }
        $post->title=$request->titre;
        $post->body=$request->body;
        $post->user_id=Auth::user()->id;
        $post->category_id=1;
        $post->save();
        return redirect()->back()->with('success','Article Modifié');
     }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id)->delete();
        return redirect('/')->with('success','Article supprimé');

    }

    public function search(Request $request)
    {
        $posts = DB::table('posts')                     
        ->where('title' , 'like', '%'.$request->search.'%')
        ->where('body' , 'like', '%'.$request->search.'%')->paginate(2);
        $lastAddedPosts=Post::orderBy('created_at');
    return view('posts.search',compact('posts','lastAddedPosts'));
       

    }
}
