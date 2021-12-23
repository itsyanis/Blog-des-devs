@extends('layouts.app')

@section('style')
   
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
  
    <style>
        body {
            background-color: #eee
        }
    </style>
@endsection

@section('header')
    <header class="masthead" style="background-image: url('/storage/{{ $post->image }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->subtitle }}</h2>
                        <span class="meta">
                            Posté par
                            <a href="#!">{{ $post->author->first_name .' '. $post->author->last_name }}</a>
                            {{ $post->created_at->toFormattedDateString() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')

    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    
                    @foreach ($post->tags as $tag)
                       <span class="badge bg-secondary"> {{ $tag }}</span>    
                    @endforeach

                    {!! $post->content !!}

                    <p class="post-meta">
                        Posté par
                        <a href="{{ route('about') }}">{{ $post->author->first_name . ' ' . $post->author->last_name }}</a>
                        le {{ $post->created_at }}
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            </div>
        </div>
    </article>

    <!-- Comments Part -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-5">
                <h4 class="mb-4">Commentaires :</h4>
                <!-- Add Comment Form -->
                <form action="{{ route('post.comment', $post->id) }}" method="POST" is-dynamic-form>
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="author" id="author" placeholder="Entrer votre nom">
                        <div class="invalid-feedback author-error"></div>
                    </div>
    
                    <div class="mb-3">
                        <textarea name="comment" id="comment" class="form-control" placeholder="Entrer votre commentaire"></textarea>
                        <div class="invalid-feedback comment-error"></div>
                    </div>
                    
                    <!-- Comment Button -->
                    <button type="submit" class="btn btn-primary">Commenter !</button>
                </form>
                    
                <!-- List of comments -->
                <div class="comment-section">
                    @foreach ($post->comments as $comment)
                        <div class="media g-mb-30 media-comment">
                            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                <div class="g-mb-15">
                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->author_name }}</h5>
                                    <span class="g-color-gray-dark-v4 g-font-size-12">{{ $comment->created_at }}</span>
                                </div>
                                <p>{{ $comment->content }}</p> 
                            </div>
                        </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<!-- Custom JS -->
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>    
    
<script type="text/javascript">
    
    function pushComment(comment) {

        let comment_html = `<div class="media g-mb-30 media-comment">
                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                    <div class="g-mb-15">
                                        <h5 class="h5 g-color-gray-dark-v1 mb-0">${comment.author_name}</h5>
                                        <span class="g-color-gray-dark-v4 g-font-size-12">${comment.created_at}</span>
                                    </div>
                                    <p>${comment.content}</p>    
                                </div>
                            </div>`;

        $('.comment-section').append(comment_html);
    }
</script>
@endsection