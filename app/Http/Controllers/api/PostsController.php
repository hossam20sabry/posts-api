<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{

    public function index()
    {
        $posts =PostResource::collection(Post::all());
        $arr = [
            'posts' => $posts,
            'message' => 'success',
            'status' => 200
        ];
        return response($arr);
    }

    public function show($id)
    {
        $post = new PostResource(Post::find($id));
        $arr = [
            'post' => $post,
            'message' => 'success',
            'status' => 200
        ];
        if($post == null) {
            $arr = [
                'message' => 'post not found',
                'status' => 404
            ];
        }
        return response($arr);
    }
}
