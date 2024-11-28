@extends('layouts.admin.app')
@section('title')
Home
@endsection

@section('body')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    @livewire('admin.statistics')


    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->

            <div class="card-body shadow col-6">
                <!-- Card Header - Dropdown -->
                <h1>{{ $chart_post->options['chart_title'] }}</h1>
                {!! $chart_post->renderHtml() !!}

            </div>

            <div class="card-body shadow col-6">
                <!-- Card Header - Dropdown -->
                <h1>{{ $chart_user->options['chart_title'] }}</h1>
                {!! $chart_user->renderHtml() !!}

            </div>

    </div>

    <div class="row">

        <!-- Area Chart -->

            <div class="card-body shadow col-6">
                <!-- Card Header - Dropdown -->
                <h1>{{ $chart_contact->options['chart_title'] }}</h1>
                {!! $chart_contact->renderHtml() !!}

            </div>

            <div class="card-body shadow col-6">
                <!-- Card Header - Dropdown -->
                <h1>{{ $chart_comment->options['chart_title'] }}</h1>
                {!! $chart_comment->renderHtml() !!}

            </div>

    </div>

    <!-- Content Row -->
   @livewire('admin.latest_post_comment')

</div>


@endsection


@push('js')
{!! $chart_post->renderChartJsLibrary() !!}
{!! $chart_post->renderJs() !!}
{!! $chart_user->renderJs() !!}
{!! $chart_contact->renderJs() !!}
{!! $chart_comment->renderJs() !!}


@endpush


