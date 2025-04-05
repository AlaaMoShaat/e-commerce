<?php

namespace App\Services\Dashboard;

use App\Mail\ReplyContactMail;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Dashboard\Contact\ReplyContact;
use App\Repositories\Dashboard\ContactRepository;

class ContactService
{
    public $contactRepository;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getContactById($id) {
        return $this->contactRepository->getContactById($id)?? false;
    }

    public function getInboxContacts($keyword = null) {
        return $this->contactRepository->getInboxContacts($keyword);
    }

    public function getTrashedContacts($keyword = null) {
        return $this->contactRepository->getTrashedContacts($keyword);
    }

    public function getAnsweredContacts($keyword = null) {
        return $this->contactRepository->getAnsweredContacts($keyword);
    }
    public function getReadedContacts($keyword = null) {
        return $this->contactRepository->getReadedContacts($keyword);
    }

    public function deleteContact($id) {
        $contact = self::getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->deleteContact($contact);
    }

    public function markAsRead($id) {
        $contact = self::getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->markAsRead($contact);
    }

    public function markAsUnRead($id) {
        $contact = self::getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->markAsUnRead($contact);
    }

    public function replyContact($contactId, $replyMsg) {
        $contact = self::getContactById($contactId);
        if (!$contact) {
            return false;
        }
        Mail::to($contact->email)->send(new ReplyContactMail($contact->name, $replyMsg, $contact->subject));
        return true;
    }

    public function forceDeleteContact($id) {
        $contact = self::getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->forceDeleteContact($contact);
    }

   public function restoreContact($id) {
        $contact = self::getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->restoreContact($contact);
    }

    public function markAllAsRead() {
        return $this->contactRepository->markAllAsRead();
    }

    public function deleteAllReadContacts() {
        return $this->contactRepository->deleteAllReadContacts();
    }

    public function deleteAllAnsweredContacts() {
        return $this->contactRepository->deleteAllAnsweredContacts();
    }
}