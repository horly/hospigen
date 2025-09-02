<ul class="list-group custom-activity-list">
    @foreach ($notifsAll as $notif)
        @php
            $user = DB::table('users')->where('id', $notif->id_sender)->first();
        @endphp
        <li class="list-group-item custom-activity-item notif" onclick="readNotification('{{ $notif->id }}', '{{ route('app_read_notification') }}', '{{ csrf_token() }}');" >
            <div class="date-line">
                <div class="left-group">
                    <span class="bullet {{ $notif->read == 0 ? 'text-primary' : 'text-secondary' }}">•</span>
                    <span class="{{ $notif->read == 0 ? 'text-primary' : 'text-secondary' }}">
                        {{ date('Y-m-d', strtotime($notif->created_at)) }}
                    </span>
                    <span>{{ Carbon\Carbon::parse($notif->created_at)->ago() }}</span>
                </div>
                <span class="bullet {{ $notif->read == 0 ? 'text-primary' : 'text-secondary' }}">•</span>
            </div>
            <div class="content-line">
                <div class="fw-medium">{{ $user->name }} <br> <span class="text-muted">{{ __($notif->description) }}.</span></div>
                <p></p>
            </div>
        </li>
    @endforeach
</ul>
