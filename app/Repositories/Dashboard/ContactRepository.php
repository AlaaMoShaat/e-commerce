<?php

namespace App\Repositories\Dashboard;

use App\Models\Contact;

class ContactRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getMarkReadContacts() {
        return Contact::where('is_read', 1)->get();
    }

    public function getInboxContacts() {
        return Contact::get();
    }

    public function getContactById($id) {
        return Contact::withTrashed()->find($id);
    }

    public function getTrashedContacts($keyword = null) {
        return Contact::searchContact($keyword)->onlyTrashed()->latest();
    }

    public function getAnsweredContacts($keyword = null) {
        return Contact::searchContact($keyword)->where('reply_status', 1)->latest();
    }

    public function getReadedContacts($keyword = null) {
        return Contact::searchContact($keyword)->where('is_read', 1)->latest();
    }

    public function markAsRead($contact) {
        $contact->is_read = 1;
        $contact->save();
    }

    public function markAsUnRead($contact) {
        $contact->is_read = 0;
        $contact->save();
    }

    public function markAllAsRead() {
        Contact::where('is_read', 0)->update(['is_read' => 1]);
    }

    public function deleteAllReadContacts() {
        Contact::where('is_read', 1)->delete();
    }

    public function deleteAllAnsweredContacts() {
        Contact::where('reply_status', 1)->delete();
    }

    public function deleteContact($contact) {
        return $contact->delete();
    }

    public function forceDeleteContact($contact) {
        return $contact->forceDelete();
    }

    public function restoreContact($contact) {
        return $contact->restore();
    }
}
