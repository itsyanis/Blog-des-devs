<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(6);
        return view('admin.dashboard', compact('posts'));
    }


    public function search(Request $request)
    {
        if(request()->ajax())
        {
            $posts = Post::with('author')->where('title','like','%'.$request->search.'%')
                          ->orWhere('content','like','%'.$request->search.'%')
                          ->get();
            if($posts)
            {
                 return response()->json($posts);
            }
        }
    }
}
