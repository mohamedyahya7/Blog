<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    public function home()
    {
        $posts = Post::with('user', 'category')->latest()->simplePaginate(6);
        return view('frontend.home', compact('posts'))->with('userName', User::pluck('name'))->with('categoryName', Category::pluck('name'));
    
    }
    public function categories()
    {
        $categories = Category::select('id', 'name', 'description', 'image')->withCount('posts')->get();
        
        return view('frontend.categories', compact('categories'));
    }
    public function category(Category $category)
    {
        //$posts = $category->posts();dd($posts);
        $posts = Post::where('category_id',$category->id)->get();
        return view('frontend.category', ['posts' => $posts, 'category' => $category]);
    }
}
