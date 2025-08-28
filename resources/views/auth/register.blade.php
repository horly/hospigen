@extends('base')
@section('title', __('auth.register'))
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
              <form class="theme-form" action="{{ route('app_create_user') }}" method="post">
                <h2 class="text-center">{{ __('auth.register') }}</h2>
                <p class="text-center">{{ __('auth.create_an_account') }}</p>

                @include('message.flash-message')

                @csrf

                <div class="form-group">
                    <label for="full_name_register" class="col-form-label">{{ __('auth.full_name')}}</label>
                    <input type="text" name="full_name_register" id="full_name_register" class="form-control @error('full_name_register') is-invalid @enderror" placeholder="{{ __('auth.enter_your_fullname') }}" value="{{ old('full_name_register') }}">
                    <small class="text-danger">@error('full_name_register'){{ $message }}@enderror</small>
                </div>

                <div class="form-group">
                    <label for="email_register" class="col-form-label">{{ __('auth.email')}}</label>
                    <input type="email" name="email_register" id="email_register" class="form-control @error('email_register') is-invalid @enderror" placeholder="{{ __('auth.enter_your_email') }}" value="{{ old('email_register') }}">
                    <small class="text-danger">@error('email_register'){{ $message }}@enderror</small>
                </div>

                <div class="form-group">
                    <label for="password_register" class="col-form-label">{{ __('auth.password')}}</label>
                    <div class="form-input position-relative">
                        <input type="password" name="password_register" id="password_register" class="form-control @error('password_register') is-invalid @enderror" placeholder="*********" value="{{ old('password_register') }}">
                        <div class="show-hide"><i id="show-password-register" class="fa-solid fa-eye"></i><i id="hide-password-register" class="fa-solid fa-eye-slash d-none"></i></div>
                    </div>
                    <small class="text-danger">@error('password_register'){{ $message }}@enderror</small>
                </div>

                <div class="form-group">
                    <label for="password_confirm_register" class="col-form-label">{{ __('auth.password_confirmation')}}</label>
                    <div class="form-input position-relative">
                        <input type="password" name="password_confirm_register" id="password_confirm_register" class="form-control @error('password_confirm_register') is-invalid @enderror" placeholder="*********" value="{{ old('password_confirm_register') }}">
                        <div class="show-hide"><i id="show-confirm-password-register" class="fa-solid fa-eye"></i><i id="hide-confirm-password-register" class="fa-solid fa-eye-slash d-none"></i></div>
                    </div>
                    <small class="text-danger">@error('password_confirm_register'){{ $message }}@enderror</small>
                </div>

                <div class="form-group">
                    <label for="role_register" class="col-form-label">{{ __('auth.role')}}</label>
                    <select name="role_register" id="role_register" class="form-select @error('role_register') is-invalid @enderror">

                        <option value="" {{ old('role_register') === null ? 'selected' : '' }}>
                            {{ __('auth.select_the_role') }}
                        </option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_register') == $role->id ? 'selected' : '' }}>
                                {{ __('auth.' . $role->name) }}
                            </option>
                        @endforeach

                    </select>
                    <small class="text-danger">@error('role_register'){{ $message }}@enderror</small>
                </div>

                <div class="form-group mb-0 checkbox-checked">

                  <div class="text-end mt-3">
                        <button class="btn btn-primary btn-block w-100 save" type="submit">
                            {{ __('auth.register')}}
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
