<?php

// app/Http/Livewire/DatabaseNotificationsTrigger.php



namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DatabaseNotificationsTrigger extends Component
{
    public $unreadNotificationsCount;

    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function mount()
    {
        $this->fetchUnreadNotificationsCount();
    }

    public function render()
    {
        return view('livewire:filament.notifications.database-notifications');
    }

    public function getListeners()
    {
        return [
            'openDatabaseNotifications' => 'showNotifications',
            'refreshNotifications' => 'fetchUnreadNotificationsCount'
        ];
    }

    public function showNotifications()
    {
        $this->fetchUnreadNotificationsCount();
    }

    public function fetchUnreadNotificationsCount()
    {
        $this->unreadNotificationsCount = Auth::user()->unreadNotifications->count();
    }
}


