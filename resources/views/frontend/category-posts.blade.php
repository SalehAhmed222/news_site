@extends('layouts.frontend.app')
@section('title')
  Category

@endsection

@section('meta_desc')
{{$category->small_desc}}
@endsection
{{-- canonical tage to optimize seo --}}
@push('header')
<link rel="canonical" href="{{url()->full()}}"/>

@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection
@section('body')
    <!-- Main News Start-->
    <br><br><br>
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images->first()->path ) }}"  style="width: 260px;height:200px"/>
                                    <div class="mn-title">
                                        <a href="{{route('frontend.post.show',$post->slug)}}" title="{{ $post->name }}">{{ $post->name }}/a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert-info">This Category is Empty</div>
                        @endforelse

                    </div>
                    {{ $posts->links() }}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>More Categories</h2>
                        <ul>
                            @foreach ($categoriesPosts as $category)
                                <li><a href="{{ route('frontend.category.posts', $category->slug) }}"
                                        title="{{ $category->name }}">{{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
