<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        $arr = [
            'posts' => PostResource::collection($posts),
            'message' => 'success',
            'status' => 200
        ];
        return response($arr);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if($post){
            $arr = [
                'post' => new PostResource($post),
                'message' => 'success',
                'status' => 200
            ];
        }
        else{
            $arr = [
                'message' => 'post not found',
                'status' => 404
            ];
        }

        return response($arr);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        if($validator->fails()){
            $arr = [
                'message' => $validator->errors(),
                'status' => 400
            ];
            return response($arr);
        }


        $post = Post::create($request->all());
        if($post){
            $arr = [
                'post' => new PostResource($post),
                'message' => 'success',
                'status' => 201
            ];
        }
        
        return response($arr);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        if($validator->fails()){
            $arr = [
                'message' => $validator->errors(),
                'status' => 400
            ];
            return response($arr);
        }
        
        $post = Post::find($id);
        $post1 = $post->update($request->all());

        
        if($post){
            $arr = [
                'post' => new PostResource($post),
                'message' => 'success',
                'status' => 200
            ];
        }
        else{
            $arr = [
                'message' => 'post not found',
                'status' => 404
            ];
        }

        return response($arr);
    }
}
