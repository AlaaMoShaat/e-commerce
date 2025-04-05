<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\Dashboard\ContactService;

class ContactShow extends Component
{
    public $msg;
    protected $listeners = [
        'msg-deleted' => '$refresh',
        'conact-reply' => '$refresh',
        'refresh-show' => '$refresh',
    ];
    protected ContactService $contactService;

    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function mount() {
        $this->msg = Contact::latest()->first();
    }

    public function deleteMsg($msgId) {
        $this->contactService->deleteContact($msgId);
        $this->msg = Contact::latest()->first();
        $this->dispatch('msg-deleted'. 'Message Deleted Successfully');
        $this->dispatch('refresh-show');
        $this->dispatch('msg-deleted');
    }

    public function forceDeleteContact($msgId) {
        $this->contactService->forceDeleteContact($msgId);
        $this->msg = Contact::latest()->first();
        $this->dispatch('msg-deleted'. 'Message permanently deleted');
        $this->dispatch('refresh-show');
        $this->dispatch('msg-deleted');
    }

    public function restoreContact($msgId) {
        $this->contactService->restoreContact($msgId);
        $this->dispatch('refresh-message');
    }

    #[On('show-message')]
    public function showMessage($msgId){
        $this->msg = $this->contactService->getContactById($msgId);
    }

    public function replyMsg($msgId) {
        $this->dispatch('call-reply-message-component', $msgId);
    }

    public function markAsUnRead($msgId) {
        $this->contactService->markAsUnRead($msgId);
        $this->dispatch('refresh-message');
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-show');
    }
}
