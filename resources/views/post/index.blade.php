@extends('layouts.app')

@section('header')
    <header class="masthead" style="background-image: url('../img/home-bg.png')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>{{ __('general.title.blog')}}</h1>
                        <span class="subheading">{{ __('general.subheading.intro')}}</span>
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
                <div class="col-md-12 col-lg-10 col-xl-8">
                    @foreach ($posts as $post)
                        <!-- Post preview-->
                        <div class="post-preview">
                            <div class="flex d-flex justify-content-between">
                                <a href="{{ route('post.show', $post->id) }}">
                                    <h2 class="post-title">{{ $post->title }}</h2>
                                </a>
                                <small class="mt-2">{{ $post->comments->count() }} <i class="far fa-comments fa-2x"></i></small>    
                            </div>
                            <h3 class="post-subtitle">{{ $post->subtitle }}</h3>

                            @foreach ($post->tags as $tag)
                              <span class="badge bg-secondary"> {{ $tag }}</span>    
                            @endforeach

                            <p>
                                {!! Str::words($post->content, 50 , ' ...') !!}
                                <a href="{{ route('post.show',$post) }}"> {{ __('general.read_more')}} </a> 
                            </p>

                            <p class="post-meta">
                                {{ __('general.title.posted_by')}}
                                <a href="{{ route('about') }}">{{ $post->author->first_name . ' ' . $post->author->last_name }}</a>
                                , {{ $post->created_at->toFormattedDateString() }}
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
