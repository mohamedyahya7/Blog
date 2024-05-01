<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category')->latest()->simplePaginate(3);
        return view('admin.post.index', compact('posts'))->with('userName', User::pluck('name'))->with('categoryName', Category::pluck('name'));
    }
    public function create()
    {
        $categories = Category::all(['id', 'description', 'name as text']);
        $tags = Tag::all(['id', 'name as text']);
        return view('admin.post.create', compact('categories', 'tags'));
    }
    public function store(Request $request)
    {
        //artisan storage:link & in env  FILESYSTEM_DISK=public & APP_URL=http://127.0.0.1:8000 
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);
        //$data['status'] = 3;
        //$data['user_id'] = auth()->user()->id;
        $data['user_id'] = 1;
        if ($request->hasFile('image')) {
            $imageName = str_ireplace(' ', '', $data['title']) . '.' . $request->file('image')->extension();
            $data['image'] = $request->file('image')->storeAs('posts', $imageName);
        }
        $post = Post::create($data);
        $tagsIds = Self::tagsHandel($request, Tag::class);
        $post->tags()->attach([...$tagsIds]);
        return redirect(route('post.index'));
    }
    public function show(Post $post)
    {
        return view('admin.post.show', ['post' => $post]);
    }
    public function edit(Post $post)
    {

        $categories = Category::all(['id', 'name as text']);
        $tags = Tag::all(['id', 'name as text']);
        return view('admin.post.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $imageName = str_ireplace(' ', '', $data['title']) . '.' . $request->file('image')->extension();
            $data['image'] = $request->file('image')->storeAs('posts', $imageName);
        }
        $post->update($data);
        $tagsIds = Self::tagsHandel($request, Tag::class);
        $post->tags()->sync($tagsIds);
        return redirect(route('post.index'));
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('post.index'));
    }
    public function forceDelete(Post $post)
    {
        Storage::delete($post->image);
        $post->forceDelete();
        return redirect(route('post.index'));
    }
    public function tagsHandel($req, $Tag)
    {
        $tags = $req->validate(['tag_id' => 'nullable|array', 'tag_id.*' => 'string',]);
        $tagsIds = [];
        // This is a null-coalescing operator that checks if the 'tag_id' key exists in the '$tags' array. If it does, it iterates over its values. If it doesn't, it iterates over an empty array, hence the '?? []' part.

        foreach ($tags['tag_id'] ?? [] as $tag) {
            $isTag = $Tag::find($tag);
            !$isTag ? array_push($tagsIds, $Tag::create(['name' => $tag])->id) :
                array_push($tagsIds, $tag);
        };
        return $tagsIds;
    }
}
