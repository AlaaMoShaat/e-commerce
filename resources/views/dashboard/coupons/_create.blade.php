 <!-- Modal -->
 <form method="post" id="create-coupon">
     @csrf
     <div class="modal fade" id="add-coupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">{{ __('static.coupons.create_new_coupon') }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     {{-- validation errors  --}}
                     <div class="alert alert-danger" style="display: none" id="error-div">
                         <ul id="error-list"></ul>
                     </div>
                     <div class="form-body">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_code">{{ __('static.coupons.code') }}</label>
                                     <input type="text" value="{{ old('code') }}" id="coupon_code"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.coupons.code') }}" name="code">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="discount_percentage">{{ __('static.coupons.discount') }}</label>
                                     <input type="number" min="0" value="{{ old('discount_percentage') }}"
                                         id="discount_percentage" class="form-control border-primary"
                                         placeholder="{{ __('static.coupons.discount') }}" name="discount_percentage">
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="coupon_limit">{{ __('static.coupons.limit') }}</label>
                                     <input type="number" min="0" name="limit" id="coupon_limit"
                                         value="{{ old('limit') }}" placeholder="{{ __('static.coupons.limit') }}"
                                         class="form-control singleImage border-primary">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label style="display: block"
                                         for="status">{{ __('static.global.status') }}</label>
                                     @include('dashboard.includes.status-btns', ['isActive' => '0'])
                                 </div>
                             </div>

                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="start_date">{{ __('static.coupons.start_date') }}</label>
                                     <input type="date" name="start_date" id="start_date"
                                         value="{{ old('start_date') }}"
                                         placeholder="{{ __('static.coupons.start_date') }}"
                                         class="form-control singleImage border-primary">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="end_date">{{ __('static.coupons.end_date') }}</label>
                                     <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                         placeholder="{{ __('static.coupons.end_date') }}"
                                         class="form-control singleImage border-primary">
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
