<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //we add a construct to auth the user to see if it is log in, on this way we will avoid people to log  in without auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //Validate the new Post
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        //Create the post
        //request image saved stor ein file uploads and the driver to store our file s3(amazon s3) but in our case we have only our local storage which is public
        $imagePath = (request('image')->store('uploads', 'public'));
        //go to auth user get theirs posts and create, on this way it will get the id user
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' =>$imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
}
