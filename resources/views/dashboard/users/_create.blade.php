 <!-- Modal -->
 <form method="post" id="create-user">
     @csrf
     <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">{{ __('static.users.create_new_user') }}</h5>
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
                                     <label for="user_name">{{ __('static.users.name') }}</label>
                                     <input type="text" value="{{ old('name') }}" id="user_name"
                                         class="form-control border-primary" placeholder="{{ __('static.users.name') }}"
                                         name="name">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="user_email">{{ __('static.users.email') }}</label>
                                     <input type="email" min="0" value="{{ old('email') }}" id="user_email"
                                         class="form-control border-primary"
                                         placeholder="{{ __('static.users.email') }}" name="email">
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="user_password">{{ __('static.users.password') }}</label>
                                     <input type="password" name="password" id="user_password"
                                         value="{{ old('password') }}" placeholder="{{ __('static.users.password') }}"
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
                         @livewire('general.address-drop-down-dependent')
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
