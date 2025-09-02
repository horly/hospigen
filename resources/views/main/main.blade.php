@extends('base')
@section('title', __('dashboard.dashboard'))
@section('content')


@include('global.loader')

<div class="page-wrapper compact-wrapper" id="pageWrapper">

    @include('main.header')

    <div class="page-body-wrapper">
        {{--
        @include('menu.navigation-menu')
        --}}
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <h2>{{ __('dashboard.dashboard') }} </h2>
                            <p class="mb-0 text-primary">
                                <i class="fa-solid fa-city"></i>&ensp;
                                {{-- $site->name --}} -
                                <i class="fa-solid fa-door-open"></i>&ensp;
                                {{-- $room->name --}}
                            </p>
                        </div>
                        <div class="col-sm-6 col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="iconly-Home icli svg-color"></i></a></li>
                                <li class="breadcrumb-item">{{ __('dashboard.dashboard') }}</li>
                                <li class="breadcrumb-item active">{{-- $room->name --}} </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>

@include('global.scipt')

<!-- sidebar -->
<script src="{{ asset('assets/js/sidebar.js') }}"></script>
<!-- scrollbar-->
<script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>

<script src="{{ asset('assets/js/chart/morris-chart/prettify.min.js') }}"></script>

<!-- apex-->
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>

<script src="{{ asset('assets/js/custom/dashboard.js') }}"></script>

@endsection
