@php
    $notifs = null;

    $notifCount = null;

    $notifs = DB::table('notifications')
                ->join('read_notifs', 'read_notifs.id_notif', '=', 'notifications.id')
                ->where('read_notifs.id_user', Auth::user()->id)
                ->take(4)
                ->orderBy('read_notifs.id', 'desc')
                ->get();
    $notifCount = DB::table('notifications')
                ->join('read_notifs', 'read_notifs.id_notif', '=', 'notifications.id')
                ->where([
                    'read_notifs.id_user' => Auth::user()->id,
                    'read_notifs.read' => 0,
                ])
                ->count();

@endphp

<li class="custom-dropdown">
    <a href="javascript:void(0)">
        <svg>
            <use href="{{ asset('assets/svg/iconly-sprite.svg#notification') }}"></use>
        </svg>
    </a>
    <span class="badge rounded-pill badge-primary">
        @if ($notifCount <= 99)
            {{ $notifCount }}
        @else
            99+
        @endif
    </span>
    <div class="custom-menu notification-dropdown py-0 overflow-hidden">
        <h3 class="title bg-primary-light dropdown-title">Notification <a href="{{ route('app_all_notification') }}"><span class="font-primary">{{ __('dashboard.view_all') }} </span></a></h3>
        <ul class="activity-timeline">
            @foreach ($notifs as $notif)
                @php
                    $user = DB::table('users')->where('id', $notif->id_sender)->first();
                @endphp
                <li class="d-flex align-items-start notif" onclick="readNotification('{{ $notif->id }}', '{{ route('app_read_notification') }}', '{{ csrf_token() }}');">
                    <div class="activity-line"></div>
                    <div class="{{ $notif->read == 0 ? 'activity-dot-primary' : 'activity-dot-secondary' }}"></div>
                    <div class="flex-grow-1">
                    <h6 class="f-w-600 {{ $notif->read == 0 ? 'font-primary' : 'font-secondary' }}">{{ date('Y-m-d', strtotime($notif->created_at)) }} <span>{{ Carbon\Carbon::parse($notif->created_at)->ago() }}</span><span class="{{ $notif->read == 0 ? 'circle-dot-primary' : 'circle-dot-secondary' }} float-end">
                        <svg class="circle-color">
                            <use href="{{ asset('assets/svg/iconly-sprite.svg#circle') }}"></use>
                        </svg></span></h6>
                    <h5>{{ $user->name }}</h5>
                    <p class="mb-0">{{ __($notif->description) }}.</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</li>
