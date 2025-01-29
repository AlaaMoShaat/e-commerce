 <!-- Modal -->
 <form action="{{ route('dashboard.coupons.store') }}" method="post" id="update_coupon">
     @csrf
     <div class="modal fade" style="z-index: 100000" id="edit-coupon-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">{{ __('static.coupons.edit_coupon') }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     {{-- validation errors  --}}
                     <div class="alert alert-danger" style="display: none" id="error-div-edit">
                         <ul id="error-list-edit"></ul>
                     </div>
                     <div class="form-body">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_code">{{ __('static.coupons.code') }}</label>
                                     <input type="hidden" id="coupon_id_edit" name="coupon_id" value="">
                                     <input type="text" id="coupon_code_edit" class="form-control border-primary"
                                         placeholder="{{ __('static.coupons.code') }}" name="code" value="">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_discount">{{ __('static.coupons.discount') }}</label>
                                     <input type="number" min="0" id="coupon_discount_edit"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.coupons.discount') }}" name="discount_percentage"
                                         value="">
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_limit">{{ __('static.coupons.limit') }}</label>
                                     <input type="number" min="0" name="limit" id="coupon_limit_edit"
                                         placeholder="{{ __('static.coupons.limit') }}"
                                         class="form-control singleImage border-primary" value="">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_start_date">{{ __('static.coupons.start_date') }}</label>
                                     <input type="date" name="start_date" id="coupon_start_date_edit"
                                         placeholder="{{ __('static.coupons.start_date') }}"
                                         class="form-control singleImage border-primary" value="">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_end_date">{{ __('static.coupons.end_date') }}</label>
                                     <input type="date" name="end_date" id="coupon_end_date_edit"
                                         placeholder="{{ __('static.coupons.end_date') }}"
                                         class="form-control singleImage border-primary" value="">
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
