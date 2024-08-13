<button type="button"
x-data="{}"
    x-on:click="$dispatch('open-modal', { id: 'database-notifications' })"
    type="button"
    >
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




<!-- resources/views/filament/notifications/database-notifications-trigger.blade.php -->




