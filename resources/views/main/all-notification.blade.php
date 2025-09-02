@extends('base')
@section('title', __('dashboard.all_notification'))
@section('content')

@include('global.loader')

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('main.header')

    <div class="container">

        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <h2>{{ __('dashboard.all_notification') }}</h2>
                            {{-- <p class="mb-0 text-title-gray">Welcome back! Let’s start from where you left.</p> --}}
                        </div>
                        <div class="col-sm-6 col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('app_main') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                                <li class="breadcrumb-item">{{ __('dashboard.main') }}</li>
                                <li class="breadcrumb-item active">{{ __('dashboard.all_notification') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card border">
            <div class="card-body">

                @include('main.all-notification-content')

            </div>
        </div>

    </div>
</div>

@include('global.scipt')

@endsection
