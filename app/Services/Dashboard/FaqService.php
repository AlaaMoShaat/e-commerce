<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqRepository;

class FaqService
{
    protected $faqRepository;
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getFaq($id) {
        $faq = $this->faqRepository->getFaq($id);
        return $faq?? abort(404);
    }

    public function getFaqs() {
        $faqs = $this->faqRepository->getFaqs();
        return $faqs?? abort(404);
    }

    public function createFaq($data) {
        $faq = $this->faqRepository->createFaq($data);
        return $faq?? false;
    }

    public function updateFaq($id, $data) {
        $faq = self::getFaq($id);
        $faq = $this->faqRepository->updateFaq($faq, $data);
        return $faq?? false;
    }

    public function deleteFaq($id) {
        $faq = self::getFaq($id);
        $faq = $this->faqRepository->deleteFaq($faq);
        return $faq?? false;
    }
}
