@extends('base')
@section('title', __('auth.my_profile'))
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
                            <h2>{{ __('auth.my_profile')}} </h2>
                            {{-- <p class="mb-0 text-title-gray">Welcome back! Let’s start from where you left.</p> --}}
                        </div>
                        <div class="col-sm-6 col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('app_main') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                                <li class="breadcrumb-item">{{ __('dashboard.main_menu') }}</li>
                                <li class="breadcrumb-item active">{{ __('auth.my_profile')}}</li>
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

                    <div class="row mb-3 p-3">
                        <div class="profile-title avatar-showcase">
                            <div class="d-flex gap-3 avatars">
                                <div class="avatar-intial img-80 bg-light-primary"><span class="fs-1">{{ substr(Auth::user()->name, 0, 1) }}</span></div>
                                <div class="flex-grow-1">
                                    <h3 class="mb-1">{{ Auth::user()->name }} </h3>
                                    <p>{{ __('auth.' . Auth::user()->role->name) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="request-type" value="edit">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="page" value="profile">

                    <div class="col-sm-3">
                        <label for="full_name_register" class="form-label">{{ __('auth.full_name')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('full_name_register') is-invalid @enderror" name="full_name_register" id="full_name_register" placeholder="{{ __('auth.enter_your_fullname') }}" value="{{ Auth::user()->name }}">
                        <small class="text-danger">@error('full_name_register') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-sm-3">
                        <label for="email_register" class="form-label">{{ __('auth.email')}} </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="email" class="form-control @error('email_register') is-invalid @enderror" name="email_register" id="email_register" placeholder="{{ __('auth.enter_your_email') }}" value="{{ Auth::user()->email }}">
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

                    <div class="col-sm-3" hidden>
                        <label for="role_register" class="form-label">{{ __('auth.role')}} </label>
                    </div>
                    <div class="col-sm-9" hidden>
                        <select name="role_register" id="role_register" class="form-select @error('role_register') is-invalid @enderror">
                            <option value="{{ Auth::user()->role->id }}" selected>
                                {{ __('auth.' . Auth::user()->role->name) }}
                            </option>

                        </select>
                        <small class="text-danger">@error('role_register'){{ $message }}@enderror</small>
                    </div>

                    <div class="text-end">
                        @include('buttons.save-button')
                    </div>

                </form>
            </div>
        </div>

        <div class="card border">
            <div class="card-header card-header-licence">
                <h2><i class="fas fa-key me-2"></i>{{ __('dashboard.license_status') }} </h2>
                <p class="text-white">{{ __('dashboard.your_license_information') }} </p>
            </div>


            <div class="card-body">
                <!-- Date de début -->
                <div class="license-info">
                    <div class="info-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="info-content">
                        <h5>{{ __('dashboard.start_date') }} </h5>
                        <p>{{ \Carbon\Carbon::parse($licence->date_debut)->isoFormat('D MMMM YYYY') }} </p>
                    </div>
                </div>

                <!-- Date d'expiration -->
                <div class="license-info">
                    <div class="info-icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <div class="info-content">
                        <h5>{{ __('dashboard.expiration_date') }} </h5>
                        <p>{{ \Carbon\Carbon::parse($licence->date_expiration)->isoFormat('D MMMM YYYY') }} </p>
                        <div class="days-counter text-primary"><span>{{ number_format($jours_restant, 0, '', ' ') }} </span> {{ __('dashboard.days_left') }} </div>
                    </div>
                </div>

                <!-- Type de licence -->
                <div class="license-info" style="border-bottom: none; margin-bottom: 0; padding-bottom: 0;">
                    <div class="info-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="info-content">
                        <h5>{{ __('dashboard.license_type') }} </h5>
                        <p>{{ Str::ucfirst($licence->type_licence) }} </p>
                    </div>
                </div>


                <!-- Statut de la licence en bas -->
                <div class="status-container">
                    <div class="status-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="status-text">{{ __('dashboard.active_license') }} </p>
                </div>
            </div>
        </div>


    </div>

</div>

@include('global.scipt')

@endsection

