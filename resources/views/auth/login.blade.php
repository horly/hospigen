@extends('base')
@section('title', __('auth.login'))
@section('content')


@include('global.loader')

<!-- login page start-->
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
              <form class="theme-form" action="{{ route('login') }}" method="post">
                <h2 class="text-center">{{ __('auth.login') }}</h2>
                <p class="text-center">{{ __('auth.enter_your_email_&_password_to_login') }}</p>

                @include('message.flash-message')

                @csrf

                <div class="form-group">
                    <label for="email" class="col-form-label">{{ __('auth.email')}}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('auth.enter_your_email') }}" value="{{ old('email') }}">
                    <small class="text-danger">@error('email'){{ $message }}@enderror</small>
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label">{{ __('auth.password')}}</label>
                    <div class="form-input position-relative">
                        <input name="password" id="password" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="*********">
                        <div class="show-hide"><i id="show-password-login" class="fa-solid fa-eye"></i><i id="hide-password-login" class="fa-solid fa-eye-slash d-none"></i></div>
                    </div>
                    <small class="text-danger">@error('password'){{ $message }}@enderror</small>
                </div>

                <div class="form-group mb-0 checkbox-checked">
                    <div class="form-check checkbox-solid-info">
                        <input class="form-check-input" id="solid6" name="remember" id="solid6" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="solid6">{{ __('auth.remember_me')}}</label>
                    </div>
                    <a class="link" href="#">{{ __('auth.forgot_password')}}</a>

                  <div class="text-end mt-3">
                        <button class="btn btn-primary btn-block w-100 save" type="submit">
                            {{ __('auth.sign_in')}}
                        </button>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                                <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                                <span role="status">{{ __('auth.loading') }}...</span>
                            </button>
                        </div>
                  </div>

                </div>

                @include('global.langage-footer')

                {{-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="sign-up.html">Create Account</a></p> --}}

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@include('global.scipt')

@endsection
