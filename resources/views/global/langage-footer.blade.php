<div class="login-social-title">
    <h6>{{ __('auth.change_language') }}</h6>
</div>

<div class="form-group">
    <ul class="login-social">
        <li class="@if(app()->getLocale() === 'en') active @endif"><a href="{{ route('app_language', ['lang' => 'en']) }}"><i class="fa-6x flag-icon flag-icon-us"></i></a></li>
        <li class="@if(app()->getLocale() === 'fr') active @endif"><a href="{{ route('app_language', ['lang' => 'fr']) }}"><i class="fa-6x flag-icon flag-icon-fr"></i></a></li>
    </ul>
</div>
