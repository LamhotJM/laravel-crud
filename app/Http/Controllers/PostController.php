<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //View for post
    public function index()
    {
    	$post = Post::paginate(5);
    	return view('post', compact('post'));
    }

    //Create Post
    public function store(Request $request, Post $post)
    {
    	$this->validate($request, [
    		'title' => 'required'
    	]);

		$user = Auth::user();
		$user->posts()->create($request->all());
		session()->flash('message', 'Post created sucessfully.');

    	return back();
    }

    //Delete post
    public function destroy(Post $post)
    {
    	$post->delete();
    	session()->flash('message', 'Post deleted successfully.');
    	return back();
    }

    //Update post
    public function update(Post $post, Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'title' => 'required'
    	]);

    	if( $validator->fails() ){
    		return back()->withErrors($validator, 'update');
    	}else{
    		$post->update($request->all());
    		session()->flash('message', 'Post updated successfully.');
    		return back();
    	}
    }

}
