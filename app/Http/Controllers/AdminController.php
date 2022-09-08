<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manage_posts()
    {
        $posts = Post::with(['category','author'])->orderBy('created_at')->paginate(6);
        return view('admin.posts', compact('posts'));
    }

    public function manage_categories()
    {
        $categories = Category::orderBy('name')->paginate(6);
        return view('admin.categories', compact('categories'));
    }

    public function manage_users()
    {
        $users = User::paginate(6);
        return view('admin.users', compact('users'));
    }


    public function manage_contacts()
    {
        $contacts = Contact::select([])->paginate(6);
        return view('admin.contacts', compact('contacts'));
    }


    public function search(Request $request)
    {
        if (request()->ajax()) {
            $posts = Post::with('author')->where('title', 'like', '%'.$request->search.'%')
                          ->orWhere('content', 'like', '%'.$request->search.'%')
                          ->get();
            if ($posts) {
                return response()->json($posts);
            }
        }
    }
}
