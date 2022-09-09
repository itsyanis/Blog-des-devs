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
                        <div class="flex mt-4">
                            @foreach ($post->tags as $tag)
                             <span class="badge bg-secondary"> {{ $tag }}</span>    
                            @endforeach
                            <small class="comment-count">{{ $post->comments->count() }} </small>  
                            <i class="far fa-comments"></i>  
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-10 mb-5"><hr>
                    <h1>{{ $post->title }}</h1>
                    <p>{!! $post->content !!}</p>

                    <p class="post-meta">
                        Posté par
                        <a href="{{ route('about') }}">{{ $post->author->first_name . ' ' . $post->author->last_name }}</a>
                        le {{ $post->created_at->toFormattedDateString() }}
                    </p>
                </div>

                @if (Auth::user())
                    @if ($post->is_published)
                        {{-- edit & delete button  --}}
                        @include('includes.modals.delete')
                        <div class="row mb-5">
                            <div class="text-center">
                                <a type="button" class="btn btn-primary text-uppercase" href="{{ route('post.edit', $post)}}" >
                                    <i class="fa fa-edit"></i>
                                    Modifier l'article
                                </a>
                                <button type="button" class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa fa-trash"></i>
                                    Supprimer l'article
                                </button>
                            </div>
                        </div>
                    @else
                        {{-- publish the post --}}
                        <div class="row">
                            <div class="text-center">
                                <a type="button" href="{{ route('post.publish',$post) }}" class="btn btn-primary text-uppercase">Publier le post</a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </article>


    <!-- Comments Part -->
    <hr class="my-4 mt-5" />
    @if ($post->is_published)
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-5">
                    <h4 class="mb-4">Commentaires :</h4>
                    <!-- Add Comment Form -->
                    <form action="{{ route('post.comment', $post->id) }}" method="POST" is-dynamic-form>
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="author" id="author" placeholder="Entrer votre nom">
                            <small class="invalid-feedback author-error"></small>
                        </div>
        
                        <div class="mb-3">
                            <textarea name="comment" id="comment" class="form-control" placeholder="Entrer votre commentaire"></textarea>
                            <div class="invalid-feedback comment-error"></div>
                        </div>
                        
                        <!-- Comment Button -->
                        <button type="submit" class="btn btn-primary">Commenter !</button>
                    </form>
                        
                    <!-- List of comments -->
                    <div class="comment-section mt-5">
                        @foreach ($post->comments as $comment)
                            <div class="media g-mb-30 media-comment">
                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                    <div class="g-mb-15">
                                        <div class="flex d-flex">
                                            <div class="avatar">
                                                <div class="avatar__letters">
                                                    {{$comment->author_name[0]  }}                       
                                                </div>
                                            </div>
                                            <h5 class="author_name mt-2 g-color-gray-dark-v1">{{ $comment->author_name }}</h5>
                                        </div>
                                        <span class="g-color-gray-dark-v4 g-font-size-12"> {{ $comment->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a','UTC') }}</span>
                                    </div>
                                    <p>{{ $comment->content }}</p> 
                                </div>
                            </div>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('script') 
    
<!-- Custom JS -->
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>   

<script type="text/javascript">
    
    function pushComment(comment) {

        let comment_html = `<div class="media g-mb-30 media-comment">
                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                    <div class="g-mb-15">
                                        <div class="flex d-flex">
                                            <div class="avatar">
                                                <div class="avatar__letters">
                                                    ${comment[0].author_name[0]}                       
                                                </div>
                                            </div>
                                            <h5 class="author_name mt-2 g-color-gray-dark-v1">${comment[0].author_name}</h5>
                                        </div>
                                        <span class="g-color-gray-dark-v4 g-font-size-12"> ${comment[1]}</span>
                                    </div>
                                    <p>${comment[0].content}</p> 
                                </div>
                            </div>`;

        $('.comment-section').append(comment_html);
        newCount = parseInt($('.comment-count').text()) + 1;
        $('.comment-count').text(newCount);
    }
</script>
@endsection