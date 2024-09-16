<?php

namespace App\Http\Controllers;

use App\Http\Requests\postStoreRequest;
use App\Http\Requests\postUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(postStoreRequest $request)
    {
        // Check if the request contains a file named 'image'
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Generate a unique file name with time and original extension
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store the file in the public/uploads directory
            $path = $file->storeAs('uploads', $filename, 'public');

            // Add the file path to the validated data
            $validated = $request->validated();
            $validated['image'] = $path;
        } else {
            $validated = $request->validated();
        }

        // Add the user_id to the validated data
        $validated['user_id'] = auth()->id();

        // Create the post with the validated data
        Post::create($validated);

        return redirect()->route('posts.index')->with('message', 'Post created successfully');
    }
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories  = Category::find($id);
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        Post::find($id)->update($validated);
        return redirect()->route('posts.index')->with('message', 'Post update Successful');
    }



    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index');
    }
}
