<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){

    	$posts = Auth::user()->posts()->get();
    	return response()->json(['data' => $posts], 200, [], JSON_NUMERIC_CHECK);

    }

    public function store(Request $request){
        $posts = Auth::user()->posts()->create($request->all());
    }

    public function update(Request $request, $id){
        $posts = Post::find($id);

        $title = $request->input('title');
        $body = $request->input('body');

        $posts->title=$title;
        $posts->body=$body;

        $posts->save();
    }

    public function destroy($id){
        $posts = Post::find($id);
        $posts->delete();
    }
}
