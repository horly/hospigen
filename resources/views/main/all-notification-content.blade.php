<div class="mb-3 row">
    <label for="display-notif" class="col-sm-2 col-form-label">{{ __('dashboard.display') }}</label>
    <div class="col-sm-4">
        <select class="form-select" aria-label="Default select example" id="display-notif" onchange="displayNotifications();">
            <option value="{{ route('app_all_notification') }}"
                @if (Request::route()->getName() == "app_all_notification")
                    selected
                @endif>
                {{ __('dashboard.all_notification') }}
            </option>

            <option value="{{ route('app_unviewed_notifications') }}"
                @if (Request::route()->getName() == "app_unviewed_notifications")
                    selected
                @endif>
                {{ __('dashboard.unviewed_notifications') }}
            </option>
        </select>
    </div>
</div>

@include('main.notification-list')

<div class="mt-3">
    {{ $notifsAll->onEachSide(1)->links() }}
</div>

