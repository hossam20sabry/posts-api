<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Controllers\api\responses\apiResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    use apiResponse;

    public function index()
    {
        $posts = Post::all();
        
        return $this->apiResponse($posts, 'success', 200);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if($post){
            return $this->apiResponse(new PostResource($post), 'success', 200);
        }
        
        return $this->apiResponse(null, 'post not found', 404);
        

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        if($validator->fails()){
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $post = Post::create($request->all());

        if($post){
            return $this->apiResponse(new PostResource($post), 'success', 200);
        }
        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        if($validator->fails()){
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        
        $post = Post::find($id);

        if (!$post) {
            return $this->apiResponse(null, 'post not found', 404);
        }

        $post->update($request->all());
        
        
        return $this->apiResponse(new PostResource($post), 'Updated successfully', 201);
        
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->apiResponse(null, 'post not found', 404);
        }

        $post->delete();

        return $this->apiResponse(null, 'Deleted successfully', 200);
    }

}
