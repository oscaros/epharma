<button type="button">
    <x-filament::icon-button
        alias="notifications::database.modal"
        icon="heroicon-o-bell"
        class="w-5 h-5"
    >
        <x-slot name="badge">
            {{ $unreadNotificationsCount }}
        </x-slot>
        {{--        Notifications ({{ $unreadNotificationsCount }} unread)--}}
    </x-filament::icon-button>
</button>