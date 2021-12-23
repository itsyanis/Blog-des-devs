<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\helpers\Notifier;
use Cocur\Slugify\Slugify;
use League\Flysystem\File;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    /**
     * Display the published post.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::where('is_published',true)->paginate(5);
        return view('post.index', compact('posts'));
    }
    

    /**
     * Display unpublished post.
     *
     * @return \Illuminate\Http\Response
     */

    public function unpublished_post()
    {
        $posts = Post::where('is_published',false)->paginate(5);
        return view('post.inpublished.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if(request()->ajax())
        {
            $post = new Post();
       
            $slug = new Slugify();
            $post->slug = $slug->slugify($request->title);
            $post->title = ucfirst($request->title);
            $post->subtitle = ucfirst($request->subtitle);
            $post->tags = explode(',', $request->tags);
            $post->image = $this->getImage();
            $post->content = $request->content;
            $post->category()->associate($request->category);
            $post->author()->associate(Auth::user()->id);
          
            if ($post->save())
            {
                $notification = new Notifier('success','Le post a été ajouté avec succès', 'redirectToUnpublished', $post->slug);
                return $notification->toJson();
            }else
            {
                Storage::disk('public')->delete($post->image);
                $notification = new Notifier('error','Une erreur est survenue veuillez vérifier vos champs', null, null);
                return $notification->toJson();
            }
        }
    }

    /**
     * Display the specified post.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::with('comments')->where('slug', $slug)
                                      ->where('is_published', true)
                                      ->firstOrFail();
                    
        return view('post.show', compact('post'));
    }


    /**
     * Display the specified post.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show_unpublished($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('is_published', false)
                    ->firstOrFail();
                    
        return view('post.unpublished.show', compact('post'));
    }

    /**
     * Publish a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publish_post(Request $request)
    {   
        $request->validate([
          'slug' => 'required|string|exists:posts,slug',
        ]);

        $post = Post::where('slug', $request->slug)->firstOrFail();
        $post->is_published = true;
        
        if($post->save())
        {
            $notification = new Notifier('success','Le post a été ajouté avec succès', null, null);
            return $notification->toJson();
        }
        else 
        {
            $notification = new Notifier('error','Une erreur est survenue ...', null, null);
            return $notification->toJson();
        }
    } 

    /**
     * Store a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(CommentRequest $request, $post_id)
    {
        if(request()->ajax())
        {
            $comment = new Comment();
            $comment->author_name = $request->author;
            $comment->content = ucfirst($request->comment);
            $comment->post()->associate($post_id);
    
            if ($comment->save())
            {
                $notification = new Notifier('success','Commentaire ajouté', 'pushComment', $comment);
                return $notification->toJson();
            }else
            {
                $notification = new Notifier('error','Une erreur est survenue veuillez vérifier vos champs', null, null);
                return $notification->toJson();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {   
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::select('id', 'name')->get();

        if(request()->ajax())
        {
            return response()->json([
                 'file' => $post->image
            ], 200);
        }

        return view('post.edit', compact('post','categories'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $slug)
    {
        if(request()->ajax())
        {
            $post = Post::where('slug', $slug)->firstOrFail();
       
            $slug = new Slugify();
            $post->slug = $slug->slugify($request->title);
            $post->title = ucfirst($request->title);
            $post->subtitle = ucfirst($request->subtitle);
            $post->tags = explode(',', $request->tags);
            $post->image = Storage::disk('public')->exists('temp') ? $this->getImage() : $post->image;
            $post->content = $request->content;
            $post->category()->associate($request->category);
    
            if ($post->save())
            {
                $notification = new Notifier('success','Le post a été modifié avec succès', null, null);
                return $notification->toJson();
            }else
            {
                $notification = new Notifier('error','Une erreur est survenue veuillez vérifier vos champs', null, null);
                return $notification->toJson();
            }    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        if(request()->ajax())
        {
            $post = Post::findOrFail($id);

            if ($post->delete())
            {
                if(Storage::disk('public')->exists($post->image))
                {
                    Storage::disk('public')->delete($post->image);
                }
    
                $notification = new Notifier('success','Le post a été supprimé avec succès', null, null);
                return $notification->toJson();
            }else
            {
                $notification = new Notifier('error','Une erreur est survenue lors de la suppréssion', null, null);
                return $notification->toJson();
            }    
        }
    }

    /**
     * Get image path and move it to 'storage/public/posts' folder .
     *
     * @return string
     */
    private function getImage()
    {
        $tempImagePath = implode(Storage::disk('public')->files('temp/'));
        $imageName = basename($tempImagePath);
        $newImagePath = 'posts/'. $imageName;

        if(Storage::disk('public')->exists($tempImagePath))
        {
            // Move the temporary image from 'public/temp' to public 'public/posts'
            Storage::move('public/' . $tempImagePath, 'public/' . $newImagePath);
          
            // Delete the temp folder 
            Storage::disk('public')->deleteDirectory('temp');

            // Return new image Path
            return $newImagePath;
        }

        return null;
    }

    /**
     * Store the temporary dropzone file in storage '/storage/temp'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeTempFile(FileRequest $request) 
    {
        if(request()->ajax())
        {
            // Clear all files in the temp directory
            Storage::disk('public')->deleteDirectory('temp');

            if($request->file('file'))
            {
                // Get filename with the extension
                $filename = $request->file->getClientOriginalName();

                $request->file->storeAs('public/temp', $filename);
            }
        }
    }

    /**
     * Upload a CKEditor Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CKEditorUploadImage(Request $request)
    {   
        if($request->hasFile('upload')) 
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            // store the  CKEditor image on 'storage/public/posts'
            $request->file('upload')->storeAs('public/posts', $fileName);
            
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/posts/'. $fileName); 
            $msg = "L\'image a été uploadée avec succès."; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    /**
     * Update CKEditor Content.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function CKEditorUpdateContent(PostRequest $request ,Post $post)
    {
        // ici je vais faire le meme pricipe mais juste autrement
        // Je vais parcourir content_image et verifier pour chauqe content_image si strpos avec content si non je supprime
       
        // Check if image was deleted 
        if(strpos($request->content, $post->image) == false)
        {
              Storage::disk('public')->delete($post->image);
        }

        return $request->content;
    }


    /**
     * Delete a temporary dropzone file from storage '/storage/temp'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function deleteTempFile(Request $request) 
    {
        if(request()->ajax())
        {
            if(Storage::disk('public')->exists('temp/' . $request->fileName))
            {
                Storage::disk('public')->delete('temp/' . $request->fileName);
            }
        }

        return response()->json([
            'message' => 'File deleted',
        ], 200);
    }
}
