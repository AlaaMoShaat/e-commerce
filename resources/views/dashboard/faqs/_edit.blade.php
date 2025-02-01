 <!-- Modal -->
 <form action="" faq-id={{ $faq->id }} method="post" class="update-faq">
     @csrf
     @method('put')
     <div class="modal fade" id="edit-faq-{{ $faq->id }}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">{{ __('static.faqs.edit_faq') }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     {{-- validation errors  --}}
                     <div class="alert alert-danger" style="display: none" id="error-div-edit-{{ $faq->id }}">
                         <ul id="error-list-edit-{{ $faq->id }}"></ul>
                     </div>
                     <div class="form-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="faq_question_en">{{ __('static.faqs.question_en') }}</label>
                                     <input type="text" value="{{ $faq->getTranslation('question', 'en') }}"
                                         id="faq_question_en" class="form-control border-primary"
                                         placeholder="{{ __('static.faqs.question_en') }}" name="question[en]">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="faq_question_ar">{{ __('static.faqs.question_ar') }}</label>
                                     <input type="text" value="{{ $faq->getTranslation('question', 'ar') }}"
                                         id="faq_question_ar" class="form-control border-primary"
                                         placeholder="{{ __('static.faqs.question_ar') }}" name="question[ar]">
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label style="display: block"
                                         for="faq_answer_en">{{ __('static.faqs.answer_en') }}</label>
                                     <textarea class="summernote" name="answer[en]" id="faq_answer_en" cols="60" rows="10">
                                        {{ $faq->getTranslation('answer', 'en') }}
                                    </textarea>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label style="display: block"
                                         for="faq_answer_ar">{{ __('static.faqs.answer_ar') }}</label>
                                     <textarea class="summernote" name="answer[ar]" id="faq_answer_ar" cols="60" rows="10">
                                        {{ $faq->getTranslation('answer', 'ar') }}
                                    </textarea>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary"
                         data-dismiss="modal">{{ __('static.actions.cancel') }}</button>
                     <button type="submit" class="btn btn-primary">{{ __('static.actions.save') }}</button>
                 </div>
             </div>
         </div>
     </div>
 </form>
