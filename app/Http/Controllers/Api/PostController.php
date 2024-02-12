<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;


use App\Http\Resources\PostResource;


use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
* index
*
* @return void
*/
public function index()
{
    //get all posts
    $posts = Post::latest()->paginate(5);
    //return collection of posts as a resource
    return new PostResource(true, 'List Data Posts', $posts);
}

/**
* store
*
* @param mixed $request
* @return void
*/
public function store(Request $request)
{
   //define validation rules
   $validator = Validator::make($request->all(), [
    'image' =>
    'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'title' => 'required',
    'content' => 'required',
   ]);

   //check if validation fails
   if ($validator->fails()) {
    return response()->json($validator->errors(), 422);
   }

   //upload image
   $image = $request->file('image');
   $image->storeAs('public/posts', $image->hashName());

   //create post
   $post = Post::create([
    'image' => $image->hashName(),
    'title' => $request->title,
    'content' => $request->content,
   ]);

   //return response
   return new PostResource(true, 'Data Post Berhasil Ditambahkan!',
   $post);
}

public function destroy($id)
{
    $post = Post::find($id);   
    $post->delete();
    return response()->json(['message' => 'Post deleted successfully']);
}

public function update($id, Request $request)
{
    $post = Post::find($id);
    $validator = Validator::make($request->all(), [
        'image' => 'required',
        'title' => 'required',
        'content' => 'required',
    ]);

    $post->update([
        'image' => $request->title,
        'title' => $request->title,
        'content' => $request->content, 
    ]);

    return new PostResource(true, 'Post updated sukses', $post);
}

}
