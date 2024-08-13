<?php

// app/Http/Livewire/DatabaseNotifications.php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DatabaseNotifications extends Component
{
    public $notifications;

    protected $listeners = ['openDatabaseNotifications' => 'fetchNotifications'];

    public function fetchNotifications()
    {
        $this->notifications = Auth::user()->notifications;
        $this->emit('refreshNotifications');
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->fetchNotifications();
            $this->emit('refreshNotifications');
        }
    }

    public function render()
    {
        return view('livewire:filament.notifications.database-notifications');
        // return view('livewire:filament.notifications.database-notifications-trigger');
    }
}

