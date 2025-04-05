<?php

namespace App\Livewire\Dashboard\Contact;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\Dashboard\ContactService;

class ReplyContact extends Component
{
    public $contact;
    public $id, $email, $subject, $replyMessage, $clientName;

    protected ContactService $contactService;

    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    #[On('call-reply-message-component')]
    public function luanchModal($contactId)
    {
        $this->setDataInAttributes($contactId);
        $this->dispatch('luanch-reply-contact-modal');
    }

    public function setDataInAttributes($contactId)
    {
        $this->contact = $this->contactService->getContactById($contactId);
        $this->id = $contactId;
        $this->email = $this->contact->email;
        $this->subject = $this->contact->subject;
        $this->clientName = $this->contact->name;
    }

    public function replyContact() {
        $repyStatus = $this->contactService->replyContact($this->id, $this->replyMessage);
        if (!$repyStatus) {
            return;
        }
        $this->dispatch('close-modal');
        // $this->dispatch('reply-contact-success');
    }

    public function render()
    {
        return view('livewire.dashboard.contact.reply-contact');
    }

}