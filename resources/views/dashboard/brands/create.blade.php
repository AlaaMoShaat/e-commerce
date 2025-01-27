 <!-- Modal -->
 <form action="{{ route('dashboard.brands.store') }}" method="post" enctype="multipart/form-data">
     @csrf
     <div class="modal fade" id="add-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">{{ __('static.brands.create_new_brand') }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     @include('dashboard.includes.validations')
                     <div class="form-body">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="category_name_en">{{ __('static.brands.brand_name_en') }}</label>
                                     <input type="text" value="{{ old("name['en']") }}" id="brand_name_en"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.brands.brand_name_en') }}" name="name[en]">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="brand_name_ar">{{ __('static.brands.brand_name_ar') }}</label>
                                     <input type="text" value="{{ old("name['ar']") }}" id="brand_name_ar"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.brands.brand_name_ar') }}" name="name[ar]">
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="brand_logo">{{ __('static.brands.logo') }}</label>
                                     <input type="file" name="logo" id="brand_logo"
                                         class="form-control singleImage border-primary">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label style="display: block"
                                         for="status">{{ __('static.global.status') }}</label>
                                     @include('dashboard.includes.status-btns', ['isActive' => '0'])
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
