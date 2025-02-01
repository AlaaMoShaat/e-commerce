<?php

namespace App\Repositories\Dashboard;

use App\Models\Faq;

class FaqRepository
{
    public function getFaq($id) {
        return Faq::find($id);
    }

    public function getFaqs() {
        return Faq::orderBy('id', 'desc')->get();
    }

    public function createFaq($data) {
        return Faq::create($data);
    }

    public function updateFaq($faq, $data) {
        $faq->update($data);
        return $faq;
    }

    public function deleteFaq($faq) {
        return $faq->delete();
    }
}
