<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\Dashboard\ContactService;

class ContactMessages extends Component
{
    use WithPagination;
    public $itemSearch, $page = 1;
    public $opendMsgId;
    public $screen = 'inbox';

    protected ContactService $contactService;

    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    protected $listeners = [
        'msg-deleted' => '$refresh',
        'refresh-message' => '$refresh',
    ];

    public function updatingItemSearch() {
        $this->resetPage();
    }

    public function showMessage($msgId) {
        self::markAsRead($msgId);
        $this->dispatch('show-message', $msgId);
        $this->opendMsgId = $msgId;
    }

    public function markAsRead($msgId) {
        $this->contactService->markAsRead($msgId);
    }

    #[On('select-screen')]
    public function selectScreen($screen)
    {
        $this->screen = $screen;
    }
    public function render()
    {
        $messages = Contact::query();

        if ($this->screen == 'inbox') {
            $messages = $messages->latest();
        } elseif ($this->screen =='readed') {
            $messages = $this->contactService->getReadedContacts(trim($this->itemSearch));
        } elseif ($this->screen == 'answered') {
            $messages = $this->contactService->getAnsweredContacts(trim($this->itemSearch));
        } elseif ($this->screen == 'trashed') {
            $messages = $this->contactService->getTrashedContacts(trim($this->itemSearch));
        } else {
            $messages = $messages->latest();
        }
        if($this->itemSearch) {
            $messages = $messages->where('email', 'like', '%'.$this->itemSearch.'%');
        }
        return view('livewire.dashboard.contact.contact-messages', ['messages' => $messages->paginate(5)]);
    }
}
