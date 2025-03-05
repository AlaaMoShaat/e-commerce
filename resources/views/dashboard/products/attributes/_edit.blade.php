 <!-- Modal -->
 <form action="" method="post" id="update-attribute">
     @csrf
     @method('put')
     <div class="modal fade" id="edit-attribute-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">
                         {{ __('static.products.attributes.edit_new_attribute') }}
                     </h5>
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
                                     <input type="hidden" value="" name="id" id="attribute_id_edit">
                                     <label
                                         for="attribute_name_ar_edit">{{ __('static.products.attributes.name_ar') }}</label>
                                     <input type="text" id="attribute_name_ar_edit"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.products.attributes.name_ar') }}" name="name[ar]">
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label
                                         for="attribute_name_en_edit">{{ __('static.products.attributes.name_en') }}</label>
                                     <input type="text" id="attribute_name_en_edit"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.products.attributes.name_en') }}" name="name[en]">
                                 </div>
                             </div>
                         </div>
                         <hr>
                         <div class="row attribute_values_row_edit">

                         </div>

                         <div class="row">
                             <div class="col-md-6">
                                 <button type="button" class="btn btn-primery" id="add_more_attr_vals_edit">
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
