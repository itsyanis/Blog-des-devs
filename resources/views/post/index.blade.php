@extends('layouts.app')

@section('header')
    <header class="masthead" style="background-image: url('../img/home-bg.png')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <span class="subheading">Un blog consacré aux amoureux du développment web</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">

            @if ($posts->isNotEmpty())
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @foreach ($posts as $post)
                        <!-- Post preview-->
                        <div class="post-preview">
                            <a href="{{ route('post.show', $post->slug) }}">
                                <h2 class="post-title">{{ $post->title }}</h2>
                                <h3 class="post-subtitle">{{ $post->subtitle }}</h3>
                            </a>

                            @foreach ($post->tags as $tag)
                              <span class="badge bg-secondary"> {{ $tag }}</span>    
                            @endforeach

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
                </div>
            @endif
        </div>
    </div>
@endsection
