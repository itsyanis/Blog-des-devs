<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::with(['category', 'author'])->where('is_published', true)->orderByDesc('created_at')->paginate(5);
        return view('index', compact('posts'));
    }

    /**
     * Display the 'about' page.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function about()
    {
        return view('about');
    }

    /**
     * Display the 'contact' page.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function contact()
    {
        return view('contact');
    }

    /**
     * Download CV function.
     *
     */
    public function download_CV()
    {
        return Storage::disk('public')->download('posts/1627506701536_laravel.png');
    }
}
