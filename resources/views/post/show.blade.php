@extends('layouts.main')

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up"
               data-aos-delay="200">{{ isset($post->user->name) ? 'Автор - ' . $post->user->name . ' • ' : '' }}
                {{ $date->translatedFormat('F') . ' ' . $date->day . ', '  . $date->year . ' • ' . $date->format('H:i')}} {{ isset($posr->comments) ? ' • ' . $post->comments->count() . ' • Комментария' : '' }}
            </p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->preview_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        {!! $post->content !!}
                    </div>
            </section>

            <div class="row">
                <div class="col-lg-9 mx-auto">
                    @auth()
                        <section class="pb-4">
                            <form action="{{ route('post.like.store', $post->id) }}" method="post">
                                @csrf
                                <span>{{ $post->likedUsers->count() }}</span>
                                <button type="submit" class="border-0 bg-transparent">
                                    <i class="fa{{ in_array( $post->id , auth()->user()->likedPosts()->pluck('id')->toArray()) ? 's' : 'r' }} fa-heart"></i>
                                </button>
                            </form>
                        </section>
                    @endauth
                    @if($relatedPosts->count() > 0)
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Схожие посты</h2>
                            <div class="row">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                        <a href="{{ route('post.show', $relatedPost->id) }}">
                                            <img src="{{ asset('storage/' . $relatedPost->preview_image) }}"
                                                 alt="related post" class="post-thumbnail">
                                        </a>
                                        <a href="{{ route('post.show', $relatedPost->id) }}">
                                            <p class="post-category">{{ $relatedPost->category->title }}</p>
                                        </a>
                                        <a href="{{ route('post.show', $relatedPost->id) }}">
                                            <h5 class="post-title">{{ $relatedPost->title }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                    @auth()
                        <section class="comment-section">
                            <h2 class="section-title mb-2" data-aos="fade-up">Оставить коментарий</h2>
                            <form action="{{ route('post.comment.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                        <label for="comment" class="sr-only">Comment</label>
                                        <textarea name="massage" id="comment" class="form-control"
                                                  placeholder="Напиши коментарий :)" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Оставить коментарий" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </section>
                    @endauth
                    <section class="comment-list mb-5" data-aos="fade-up">
                        <h2 class="section-title mb-4">Коментарии ({{ $post->comments->count() }})</h2>
                        @foreach($post->comments as $comment)
                            <div class="comment-text mb-3">
                                <span class="username">
                                    <div class="" style="font-weight: bold; color: #495057">
                                        {{ $comment->user->name }}
                                    </div>
                                  <span
                                      class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                                </span><!-- /.username -->
                                {{ $comment->massage }}
                            </div>
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
