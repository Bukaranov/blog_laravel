@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Блог</h1>
            <section class="featured-posts-section">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-right">
                            <div class="blog-post-thumbnail-wrapper">
                                <a href="{{ route('post.show', $post->id) }}">
                                    <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">
                                </a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="blog-post-category">{{$post->category->title}}</p>
                                @auth()
                                <form action="{{ route('post.like.store', $post->id) }}" method="post">
                                    @csrf
                                    <span>{{ $post->likedUsers->count() }}</span>
                                    <button type="submit" class="border-0 bg-transparent">
                                            <i class="fa{{ in_array( $post->id , auth()->user()->likedPosts()->pluck('id')->toArray()) ? 's' : 'r' }} fa-heart"></i>
                                    </button>
                                </form>
                                @endauth
                            </div>
                            <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                                <h6 class="blog-post-title"> {!! $post->title !!}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="mx-auto" style="margin-top: -100px;">
                        {{ $posts->links() }}
                    </div>
                </div>
            </section>
{{--            <div class="row">--}}
{{--                <div class="col-md-8">--}}
{{--                    <section>--}}
{{--                        <div class="row blog-post-row">--}}
{{--                            @foreach($randomPosts as $post)--}}
{{--                                <div class="col-md-6 blog-post" data-aos="fade-up">--}}
{{--                                    <div class="blog-post-thumbnail-wrapper">--}}
{{--                                        <a href="{{ route('post.show', $post->id) }}">--}}
{{--                                            <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <p class="blog-post-category">{{$post->category->title}}</p>--}}
{{--                                    <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">--}}
{{--                                        <h6 class="blog-post-title">{!! $post->title !!}</h6>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </section>--}}
{{--                </div>--}}
{{--                <div class="col-md-4 sidebar" data-aos="fade-left">--}}

{{--                    <div class="widget widget-post-list">--}}
{{--                        <h5 class="widget-title">Post List</h5>--}}
{{--                        <ul class="post-list">--}}
{{--                            @foreach($likedPosts as $post)--}}
{{--                                <li class="post">--}}
{{--                                    <a href="{{ route('post.show', $post->id) }}" class="post-permalink media">--}}
{{--                                        <a href="{{ route('post.show', $post->id) }}">--}}
{{--                                            <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">--}}
{{--                                        </a>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h6 class="post-title">{{$post->title}}</h6>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

    </main>
@endsection
