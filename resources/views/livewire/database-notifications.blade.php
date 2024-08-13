<!-- resources/views/livewire/database-notifications-trigger.blade.php -->

<button type="button" @click="Livewire.emit('openDatabaseNotifications')">
    Notifications ({{ $unreadNotificationsCount }} unread)
</button>


<div>
    
    @if ($notifications->isEmpty())
        <p>No notifications </p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li>
                    {{ $notification->data['message'] }}
                    @if ($notification->unread())
                        <button wire:click="markAsRead('{{ $notification->id }}')">Mark as read</button>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>