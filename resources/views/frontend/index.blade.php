@extends('layouts.frontend.app')
@section('title')
    Home
@endsection
{{-- meta description tage to optimize seo --}}

@section('meta_desc')
    {{$getSetting->small_desc}}
@endsection

{{-- canonical tage to optimize seo --}}
@push('header')
<link rel="canonical" href="{{url()->full()}}"/>

@endpush


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
@endsection

@section('body')
    @php
        $latest_three_posts = $posts->take(3);
    @endphp
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach ($latest_three_posts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" style="width: 550px;height:350px"/ />
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                @php
                    $latest_four_posts = $posts->take(4);
                @endphp


                <div class="col-md-6 tn-right">
                    <div class="row">
                        @foreach ($latest_four_posts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ asset($post->images->first()->path) }}"  style="width: 300px;height:200px"//>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach ($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach ($category->posts as $post)
                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img src="{{ asset($post->images->first()->path) }}"  style="width: 260px;height:200px"//>
                                        <div class="cn-title">
                                            <a
                                                href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Category News End-->




    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#oldest">oldest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="oldest" class="container tab-pane active">
                            @foreach ($oldest_news as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset($post->images->first()->path) }}" style="width: 150px;height:150px" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach ($greatest_posts_comment as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset($post->images->first()->path) }}"style="width: 150px;height:150px" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>


                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="m-viewed" class="container tab-pane active">

                            @foreach ($latest_three_posts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset($post->images->first()->path) }}" style="width: 150px;height:150px" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="m-read" class="container tab-pane fade">
                            @foreach ($greatest_num_of_views as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset($post->images->first()->path) }}" style="width: 150px;height:150px"/>
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}
                                            {{ $post->num_of_views }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images->first()->path) }}"  style="width: 260px;height:200px"//>
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>

                            @foreach ($read_more_posts as $post)
                                <li><a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
