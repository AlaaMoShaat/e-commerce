 <!-- Modal -->
 <form action="" method="post" id="create-attribute">
     @csrf
     <div class="modal fade" id="add-attribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">
                         {{ __('static.products.attributes.create_new_attribute') }}
                     </h5>
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
                                     <label
                                         for="attribute_name_ar">{{ __('static.products.attributes.name_ar') }}</label>
                                     <input type="text" id="attribute_name_ar" class="form-control border-primary"
                                         placeholder="{{ __('static.products.attributes.name_ar') }}" name="name[ar]">
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label
                                         for="attribute_name_en">{{ __('static.products.attributes.name_en') }}</label>
                                     <input type="text" id="attribute_name_en" class="form-control border-primary"
                                         placeholder="{{ __('static.products.attributes.name_en') }}" name="name[en]">
                                 </div>
                             </div>
                         </div>
                         <hr>
                         <div class="row attribute_values_row">
                             <div class="col-md-5">
                                 <div class="form-group">
                                     <label
                                         for="attribute_value_ar">{{ __('static.products.attributes.value_ar') }}</label>
                                     <input type="text" id="attribute_value_ar" class="form-control border-primary"
                                         placeholder="{{ __('static.products.attributes.value_ar') }}"
                                         name="value[1][ar]">
                                 </div>
                             </div>

                             <div class="col-md-5">
                                 <div class="form-group">
                                     <label
                                         for="attribute_value_en">{{ __('static.products.attributes.value_en') }}</label>
                                     <input type="text" id="attribute_value_en" class="form-control border-primary"
                                         placeholder="{{ __('static.products.attributes.value_en') }}"
                                         name="value[1][en]">
                                 </div>
                             </div>
                             <div class="col-md-2 mt-2">
                                 <button type="button" disabled class="btn btn-danger removeValRow"><i
                                         class="ft-x"></i></button>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6">
                                 <button type="button" class="btn btn-primery" id="add_more_attr_vals">
                                     <i class="ft-plus"></i>
                                 </button>
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
