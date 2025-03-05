<section id="icon-tabs">
    @if (!empty($successMessage) && $currentStep == 1)
        <div class="alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ $successMessage }}!</strong>
        </div>
    @endif

    <ul class="wizard-timeline center-align">
        <li class="{{ $currentStep > 1 ? 'completed' : '' }}">
            <span class="step-num">1</span>
            <label>{{ __('static.products.basic_information') }}</label>
        </li>
        <li class="{{ $currentStep > 2 ? 'completed' : '' }}">
            <span class="step-num">2</span>
            <label>{{ __('static.products.product_variants') }}</label>
        </li>
        <li class="active {{ $currentStep > 3 ? 'completed' : '' }}">
            <span class="step-num">3</span>
            <label>{{ __('static.products.product_images') }}</label>
        </li>
        <li class="{{ $currentStep == 4 ? 'completed' : '' }}">
            <span class="step-num">4</span>
            <label>{{ __('static.actions.confirmation') }}</label>
        </li>
    </ul>

    <form class="wizard-circle">

        {{-- first step Product Basic Info --}}
        <div class="setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
            <h3>{{ __('static.products.basic_information') }}</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_ar"> {{ __('static.products.product_name_ar') }} :</label>
                        <input wire:model.lazy="name_ar" type="text" class="form-control" id="name_ar"
                            placeholder="{{ __('static.products.product_name_ar') }}">
                        @error('name_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_en"> {{ __('static.products.product_name_en') }} :</label>
                        <input wire:model.lazy="name_en" type="text" class="form-control" id="name_en"
                            placeholder="{{ __('static.products.product_name_en') }}">
                        @error('name_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="small_desc_ar"> {{ __('static.products.product_small_description_ar') }}
                            :</label>
                        <textarea wire:model.lazy="small_desc_ar" class="form-control" id="small_desc_ar"></textarea>
                        @error('small_desc_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="small_desc_en"> {{ __('static.products.product_small_description_en') }}
                            :</label>
                        <textarea wire:model.lazy="small_desc_en" class="form-control" id="small_desc_en"></textarea>
                        @error('small_desc_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="desc_ar"> {{ __('static.products.product_description_ar') }} :</label>
                        <textarea wire:model.lazy="desc_ar" class="form-control" id="desc_ar"></textarea>
                        @error('desc_ar')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="desc_en"> {{ __('static.products.product_description_en') }} :</label>
                        <textarea wire:model.lazy="desc_en" class="form-control" id="desc_en"></textarea>
                        @error('desc_en')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category_id"> {{ __('static.products.product_category') }} :</label>
                        <select wire:model.lazy="category_id" class="form-control custom-select" id="category_id">
                            <option value=""> {{ __('static.products.product_category') }} </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="brand_id"> {{ __('static.products.product_brand') }} :</label>
                        <select wire:model.lazy="brand_id" class="form-control custom-select" id="brand_id">
                            <option value=""> {{ __('static.products.product_brand') }} </option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sku"> {{ __('static.products.product_sku') }} :</label>
                        <input wire:model.lazy="sku" type="text"
                            placeholder="{{ __('static.products.product_sku') }}" class="form-control"
                            id="sku">
                        @error('sku')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="available_for"> {{ __('static.global.available_for') }} :</label>
                        <input wire:model.lazy="available_for" placeholder="{{ __('static.global.available_for') }}"
                            type="date" class="form-control" id="available_for">
                        @error('available_for')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tagInput"> {{ __('static.products.product_tags') }} :</label>
                        <input type="text" wire:model="tags" id="tagInput"
                            placeholder="{{ __('static.products.product_tags') }}" class="form-control">
                        @error('tags')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

            </div>
            <button class="btn btn-primary pull-left mb-3" wire:click="firstStepSubmit"
                type="button">{{ __('static.global.next') }}</button>
        </div>

        {{-- second step Product Variants? --}}
        <div class="setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
            <h3>{{ __('static.products.product_variants') }}</h3>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="has_variants"> {{ __('static.products.has_variants') }} :</label>
                        <select name="has_variants" id="has_variants" wire:model.lazy="has_variants"
                            class="form-control">
                            <option value="0" selected>{{ __('static.global.no') }}</option>
                            <option value="1">{{ __('static.global.yes') }}</option>
                        </select>
                        @error('has_variants')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if (!$has_variants)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="price">{{ __('static.products.product_price') }} :</label>
                            <input type="number" class="form-control" name="price" id="price"
                                wire:model.="price" pllazyaceholder="{{ __('static.products.product_price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
                @if (!$has_variants)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="manage_stock">{{ __('static.products.manage_stock') }} :</label>
                            <select name="manage_stock" id="manage_stock" class="form-control"
                                wire:model.lazy="manage_stock">
                                <option value="0" selected>{{ __('static.global.no') }}</option>
                                <option value="1">{{ __('static.global.yes') }}</option>
                            </select>
                            @error('manage_stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
                {{-- depend on Manage stock --}}
                @if ($manage_stock && !$has_variants)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">{{ __('static.products.product_quantity') }} :</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                wire:model.lazy="quantity"
                                placeholder="{{ __('static.products.product_quantity') }}">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="col-6">
                    <div class="form-group">
                        <label for="status">{{ __('static.products.has_discount') }} :</label>
                        <select name="status" id="status" class="form-control" wire:model.lazy="has_discount">
                            <option value="0" selected>{{ __('static.products.no_discount') }}</option>
                            <option value="1">{{ __('static.products.has_discount') }}</option>
                        </select>
                        @error('has_discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- depend on has discount --}}
                @if ($has_discount)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="discount">{{ __('static.products.discount') }}</label>
                            <input class="form-control" id="discount" type="number" wire:model.lazy="discount"
                                placeholder="{{ __('static.products.discount') }}">
                            @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="start_discount">{{ __('static.products.start_discount') }}</label>
                            <input type="date" id="start_discount" wire:model.lazy="start_discount"
                                class="form-control" placeholder="{{ __('static.products.start_discount') }}">
                            @error('start_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="end_discount">{{ __('static.products.end_discount') }}</label>
                            <input type="date" id="end_discount" wire:model.lazy="end_discount"
                                class="form-control" placeholder="{{ __('static.products.end_discount') }}">
                            @error('end_discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>

            {{-- variants --}}
            @if ($has_variants)
                <hr class="bg-black">
                @for ($i = 0; $i < $valueRowCount; $i++)
                    <div class="row">
                        <hr>
                        <div class="col-3">
                            <div class="form-group">
                                <label
                                    for="prices.{{ $i }}">{{ __('static.products.product_price') }}</label>
                                <input wire:model="prices.{{ $i }}" id="prices.{{ $i }}"
                                    type="number" class="form-control"
                                    placeholder="{{ __('static.products.product_price') }}">
                                @error('prices.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label
                                    for="quantities.{{ $i }}">{{ __('static.products.product_quantity') }}</label>
                                <input wire:model="quantities.{{ $i }}"
                                    id="quantities.{{ $i }}" type="number" class="form-control"
                                    placeholder="{{ __('static.products.product_quantity') }}">
                                @error('quantities.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($productAttributes as $attr)
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="attributeValues.{{ $i }}.{{ $attr->id }}">
                                        {{ $attr->name }}</label>
                                    <select wire:model="attributeValues.{{ $i }}.{{ $attr->id }}"
                                        id="attributeValues.{{ $i }}.{{ $attr->id }}"
                                        class="form-control">
                                        <option value="" selected>{{ __('static.global.select') }}</option>

                                        @foreach ($attr->attributeValues as $item)
                                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    <hr class="bg-black">
                @endfor
                <button type="button" wire:click="addNewVariant" class="btn btn-success"><i class="la la-plus"></i>
                    {{ __('static.products.add_variant') }}</button>
                <button type="button" wire:click="removeVariant" class="btn btn-danger"><i class="la la-minus"></i>
                    {{ __('static.products.remove_variant') }}</button>
            @endif


            <button class="btn btn-primary pull-left  mb-3 ml-1" type="button"
                wire:click="secondStepSubmit">{{ __('static.global.next') }}</button>
            <button class="btn btn-danger  pull-left" type="button"
                wire:click="back(1)">{{ __('static.global.previous') }}</button>
        </div>

        {{-- third step Product Images --}}
        <div class="setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            <h3>{{ __('static.products.product_images') }}</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="images"> {{ __('static.products.product_images') }} :</label>
                        <input type="file" id="images" wire:model.lazy="images" class="form-control" multiple>
                    </div>
                </div>
                @error('images')
                    <div class="col-md-12 alert  alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                @if ($images)
                    <div class="col-md-12">
                        @foreach ($images as $key => $image)
                            <div class="position-relative d-inline-block mr-2 mb-2">
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail rounded-md"
                                    width="300px" height="300px">

                                <!-- Delete Button -->
                                <button type="button" wire:click="deleteImage({{ $key }})"
                                    class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Fullscreen Button -->
                                <button type="button" wire:click="openFullscreen({{ $key }})"
                                    class="btn btn-primary btn-sm position-absolute" style="bottom: 5px; right: 5px;">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Fullscreen Modal (Optional) -->
            <div wire:ignore.self class="modal fade" id="fullscreenModal" tabindex="-1"
                aria-labelledby="fullscreenModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ $fullscreenImage }}" class="img-fluid" id="fullscreenImage"
                                alt="Full Screen Image">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success  pull-left  mb-3 ml-1" wire:click="thirdStepSubmit"
                type="button">{{ __('static.global.next') }}</button>
            <button class="btn btn-danger  pull-left  mb-3" type="button"
                wire:click="back(2)">{{ __('static.global.previous') }}</button>

        </div>

        {{-- Confirm Step Display Data --}}
        <div class="setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
            {{ __('static.actions.confirmation') }}
            <div class="row">

            </div>

            <button class="btn btn-success  pull-left  mb-3 ml-1" wire:click="submitForm"
                type="button">{{ __('static.actions.confirmation') }}</button>
            <button class="btn btn-danger  pull-left  mb-3" type="button"
                wire:click="back(3)">{{ __('static.global.previous') }}</button>

        </div>

    </form>
</section>
