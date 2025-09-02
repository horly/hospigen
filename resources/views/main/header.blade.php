@php
    if (!Auth::user()) {
        return redirect()->route('app_logout');
    }
@endphp

<header class="page-header row">
    <div class="logo-wrapper d-flex align-items-center col-auto">
        <a href="{{ route('app_main') }}"><img class="light-logo img-fluid" src="{{ asset('assets/images/logo/HOSPIGEN-WH-ICON.png') }}" width="30" alt="logo"/><img class="dark-logo img-fluid" src="{{ asset('assets/images/logo/HOSPIGEN-WH-ICON.png') }}" width="30" alt="logo"/></a>

        <a class="close-btn toggle-sidebar" href="javascript:void(0)">
            <i class="iconly-Category icli"></i>
        </a>
    </div>

    <div class="page-main-header col">
        <div class="header-left">
        </div>

        <div class="nav-right">
            <ul class="header-right">
                <li class="custom-dropdown">
                    <div class="translate_wrapper">
                        <div class="current_lang">
                            <a class="lang" href="javascript:void(0)">
                                @if (Config::get('app.locale') == 'en')
                                    <i class="flag-icon flag-icon-gb"></i>
                                    <h6 class="lang-txt f-w-700">ENG</h6>
                                @else
                                    <i class="flag-icon flag-icon-fr"></i>
                                    <h6 class="lang-txt f-w-700">FR</h6>
                                @endif
                            </a>
                        </div>
                        <ul class="custom-menu profile-menu language-menu py-0 more_lang">
                            <li class="d-block">
                                <a class="lang" href="{{ route('app_language', ['lang' => 'en']) }}" data-value="English">
                                    <i class="flag-icon flag-icon-us"></i>
                                    <div class="lang-txt">English</div>
                                </a>
                            </li>
                            <li class="d-block">
                                <a class="lang" href="{{ route('app_language', ['lang' => 'fr']) }}" data-value="fr">
                                    <i class="flag-icon flag-icon-fr"></i>
                                    <div class="lang-txt">Français</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="search d-lg-none d-flex">
                    <a href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg#Search') }}"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="dark-mode" href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg#moondark') }}"></use>
                        </svg>
                    </a>
                </li>

                {{-- Notification --}}
                @include('global.notification')

                <li>
                    <a class="full-screen" href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg#scanfull') }}"></use>
                        </svg>
                    </a>
                </li>

                <li class="profile-nav custom-dropdown">
                    <div class="user-wrap avatar-showcase">
                        <div class="user-img avatars">
                            <div class="avatar-intial img-40 bg-light-primary"><span class="fs-5">{{ substr(Auth::user()->name, 0, 1) }}</span></div>
                        </div>
                        <div class="user-content">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p class="mb-0">{{ __('auth.' . Auth::user()->role->name) }}<i class="fa-solid fa-chevron-down"></i></p>
                        </div>
                    </div>
                <div class="custom-menu overflow-hidden">
                    <ul class="profile-body">
                        <li class="d-flex">
                            <span class="icon-profile">
                                <i class="iconly-Home icli"></i>
                            </span>
                            <a class="ms-2" href="{{ route('app_main') }}">{{ __('dashboard.home') }}</a>
                        </li>
                        <li class="d-flex">
                            <span class="icon-profile">
                                <i class="iconly-Profile icli"></i>
                            </span>
                            <a class="ms-2" href="{{ route('app_profile') }}">{{ __('dashboard.account') }}</a>
                        </li>
                        <li class="d-flex">
                            <span class="icon-profile">
                                <i class="iconly-User2 icli"></i>
                            </span>
                            <a class="ms-2" href="{{ route('app_user_management') }}">{{ __('dashboard.user_management') }}</a>
                        </li>
                        <li class="d-flex">
                            <span class="icon-profile">
                                <i class="iconly-Login    icli"></i>
                            </span>
                            <a class="ms-2" href="{{ route('app_logout') }}">{{ __('auth.log_out') }}</a>
                        </li>
                    </ul>
                </div>
                </li>
            </ul>
        </div>
    </div>
</header>
