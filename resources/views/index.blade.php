@extends('layouts.app')

@section('header')
    <header class="masthead" style="background-image: url('img/home-bg.png')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Bienvenue</h1>
                        <span class="subheading">Un blog consacré aux amoureux du développment web</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container">
        <div class="flex d-flex justify-content-center">           
            @if ($posts->isNotEmpty())
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @foreach ($posts as $post)
                        <!-- Post preview-->
                        <div class="post-preview">
                            <a href="{{ route('post.show', $post->id) }}">
                                <div class="d-flex justify-content-between">
                                    <h2 class="post-title">{{ $post->title }} </h2> 
                                    <small>{{ $post->comments->count() }} <i class="far fa-comments fa-2x"></i></small>
                                </div>
                                <h3 class="post-subtitle">{{ $post->subtitle }}</h3>
                            </a>
                            <span class="badge bg-secondary"> {{ $post->category->name }}</span>    

                            <p>{!! Str::words($post->content, 30 , ' ...') !!}</p>
                            
                            <p class="post-meta">
                                Posté par
                                <a href="{{ route('about') }}">{{ $post->author->first_name . ' ' . $post->author->last_name }}</a>
                                le {{ $post->created_at->toFormattedDateString() }}
                            </p>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                    @endforeach

                    <div class="d-flex justify-content-between mb-4">
                        <!-- More Post-->
                        <a type="button" class="btn btn-primary text-uppercase" href="{{ route('post.index') }}">Voir tous les articles →</a>
                    </div>
                </div>
            @endif
             <!-- Create Post-->
             @if (Auth::user())
               <a type="button" href="{{ route('post.create') }}" class="btn btn-primary text-uppercase"><i class="fa fa-plus"></i> Publier un article</a>
             @endif
        </div>
    </div>
@endsection
