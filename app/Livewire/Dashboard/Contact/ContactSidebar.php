<?php

namespace App\Livewire\Dashboard\Contact;

use Livewire\Component;
use App\Services\Dashboard\ContactService;

class ContactSidebar extends Component
{
    public $screen = 'inbox';

    protected $listeners = [
        'msg-deleted' => '$refresh',
    ];

    protected ContactService $contactService;

    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    public function selectScreen($screen)
    {
        $this->screen = $screen;
        $this->dispatch('select-screen', $screen);
    }

    public function markAllAsRead() {
        $this->contactService->markAllAsRead();
        $this->dispatch('refresh-message');
    }

    public function deleteAllReadContacts() {
        $this->contactService->deleteAllReadContacts();
        $this->dispatch('msg-deleted');
    }

    public function deleteAllAnsweredContacts() {
        $this->contactService->deleteAllAnsweredContacts();
        $this->dispatch('msg-deleted');
    }
    public function render()
    {
        return view('livewire.dashboard.contact.contact-sidebar', [
            'inboxCount' => $this->contactService->getInboxContacts()->count(),
            'answeredCount' => $this->contactService->getAnsweredContacts()->count(),
            'trashedCount' => $this->contactService->getTrashedContacts()->count(),
            'readedCount' => $this->contactService->getReadedContacts()->count(),
        ]);
    }
}
