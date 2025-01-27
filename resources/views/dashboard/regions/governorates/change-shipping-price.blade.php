<form class="shipping-price-form" action="" method="post" governorate-id={{ $governorate->id }}>
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit-price-{{ $governorate->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('static.global.change_price') }} :
                        {{ $governorate->name }}
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div id="error_{{ $governorate->id }}" class="alert alert-danger" style="display: none"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number" min="0" name="price"
                            value="{{ $governorate->shippingGovernorate->price }}"
                            placeholder="{{ __('static.global.price') }}" class="form-control">
                        <br>

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
