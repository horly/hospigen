@extends('base')
@section('title', $user ? __('auth.update_user') : __('auth.add_user'))
@section('content')

@include('global.loader')

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('main.header')

    <div class="container">
        <div class="page-body">
            <div class="container-fluid general-widget">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <h2>{{ $user ? __('auth.update_user') : __('auth.add_user') }} </h2>
                            {{-- <p class="mb-0 text-title-gray">Welcome back! Let’s start from where you left.</p> --}}
                        </div>
                        <div class="col-sm-6 col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('app_user_management') }}"><i class="iconly-User3 icl svg-color"></i></a></li>
                                <li class="breadcrumb-item">{{ __('dashboard.user_management') }} </li>
                                <li class="breadcrumb-item active">{{ $user ? __('auth.update_user') : __('auth.add_user') }} </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('message.flash-message')

        <div class="card border">
            <div class="card-body">
                <form class="theme-form row g-3" action="{{ route('app_create_user_admin') }}" method="POST">
                    @csrf

                    <input type="hidden" name="request-type" value="{{ $user ? "edit" : "add" }}">
                    <input type="hidden" name="id" value="{{ $user ? $user->id : "0" }}">
                    <input type="hidden" name="page" value="add_user">

                    <div class="col-sm-3">
                        <label for="full_name_register" class="form-label">{{ __('auth.full_name')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('full_name_register') is-invalid @enderror" name="full_name_register" id="full_name_register" placeholder="{{ __('auth.enter_the_users_full_name') }}" value="{{ $user ? $user->name : old('full_name_register') }}">
                        <small class="text-danger">@error('full_name_register') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-sm-3">
                        <label for="email_register" class="form-label">{{ __('auth.email')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="email" class="form-control @error('email_register') is-invalid @enderror" name="email_register" id="email_register" placeholder="{{ __('auth.enter_the_users_email_address') }}" value="{{ $user ? $user->email : old('email_register') }}">
                        <small class="text-danger">@error('email_register') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-sm-3">
                        <label for="password_register" class="form-label">{{ __('auth.password')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-input position-relative">
                            <input type="password" class="form-control @error('password_register') is-invalid @enderror" name="password_register" id="password_register" placeholder="*********" value="{{ old('password_register') }}">
                            <div class="show-hide2"><i id="show-password-register" class="fa-solid fa-eye"></i><i id="hide-password-register" class="fa-solid fa-eye-slash d-none"></i></div>
                        </div>
                        <small class="text-danger">@error('password_register') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-sm-3">
                        <label for="password_confirm_register" class="form-label">{{ __('auth.password_confirmation')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-input position-relative">
                            <input type="password" class="form-control @error('password_confirm_register') is-invalid @enderror" name="password_confirm_register" id="password_confirm_register" placeholder="*********" value="{{ old('password_confirm_register') }}">
                            <div class="show-hide2"><i id="show-confirm-password-register" class="fa-solid fa-eye"></i><i id="hide-confirm-password-register" class="fa-solid fa-eye-slash d-none"></i></div>
                        </div>
                        <small class="text-danger">@error('password_confirm_register') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-sm-3">
                        <label for="role_register" class="form-label">{{ __('auth.role')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <select name="role_register" id="role_register" class="form-select @error('role_register') is-invalid @enderror">

                            @if ($user)
                                <option value="{{ $user->role->id }}" selected>
                                    {{ __('auth.' . $user->role->name) }}
                                </option>
                            @else
                                <option value="" {{ old('role_register') === null ? 'selected' : '' }}>
                                    {{ __('auth.select_the_role') }}
                                </option>
                            @endif

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_register') == $role->id ? 'selected' : '' }}>
                                    {{ __('auth.' . $role->name) }}
                                </option>
                            @endforeach

                        </select>
                        <small class="text-danger">@error('role_register'){{ $message }}@enderror</small>
                    </div>

                    @if (Auth::user()->role->name === "admin" || Auth::user()->role->name === "superadmin")

                        <div class="text-end">
                            @include('buttons.save-button')

                            @if ($user)
                                <button class="btn btn-danger btn-air-light" type="button" onclick="deleteElement('{{ $user->id }}', '{{ route('app_delete_user') }}', '{{ csrf_token() }}')">
                                    <i class="fa-solid fa-trash-can"></i>
                                    {{ __('dashboard.delete') }}
                                </button>
                            @endif
                        </div>

                    @endif

                </form>
            </div>
        </div>


    </div>
</div>

@include('global.scipt')

<!-- Sweetalert js-->
<script src="{{ asset('assets/lib/sweet-alert/sweetalert.min.js') }}"></script>

@endsection
