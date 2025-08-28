@extends('base')
@section('title', __('licence.add_a_license'))
@section('content')

@include('global.loader')

<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div class="mb-5">
                        <a href="/">
                            <img class="mx-auto d-block" src="assets/images/logo/HOSPIGEN.png" width="120" alt="logo">
                        </a>
                    </div>

                    <div class="login-main">
                        <form class="theme-form" action="{{ route('app_save_license') }}" method="post">
                            <h2 class="text-center">{{ __('licence.add_a_license') }}</h2>

                            <p class="text-center">{{ __('licence.enter_the_12_characters') }}</p>

                            @include('message.flash-message')

                            @csrf

                            <div class="d-flex flex-row justify-content-center">
                                <input type="text" class="form-control me-2 @error('license-day') is-invalid @enderror" id="license-day" name="license-day" placeholder="XXXX" value="{{ old('license-day') }}">
                                <input type="text" class="form-control me-2 @error('license-month') is-invalid @enderror" id="license-month" name="license-month" placeholder="XXXX" value="{{ old('license-month') }}">
                                <input type="text" class="form-control me-2 @error('license-year') is-invalid @enderror" id="license-year" name="license-year" placeholder="XXXX" value="{{ old('license-year') }}">
                                <input type="text" class="form-control me-2 @error('license-type') is-invalid @enderror" id="license-type" name="license-type" placeholder="XXXX" value="{{ old('license-type') }}">
                            </div>
                            <small class="text-danger">
                                @if($errors->has('license-day') || $errors->has('license-month') || $errors->has('license-year') || $errors->has('license-type'))
                                    {{ __('licence.all_fields_are_required') }}
                                @endif
                            </small>

                            <div class="mb-3"></div>

                            <div class="d-grid gap-2">
                                @include('buttons.save-button')
                            </div>

                            @include('global.langage-footer')

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@include('global.scipt')

@endsection
