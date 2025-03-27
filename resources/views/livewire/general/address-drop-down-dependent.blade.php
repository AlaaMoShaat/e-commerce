<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="user_country">{{ __('static.users.country') }}</label>
            <select name="country_id" wire:model.live="countryId" class="form-control border-primary" id="country_id">
                <option value="" selected>{{ __('static.global.select') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="user_governorate">{{ __('static.users.governorate') }}</label>
            <select name="governorate_id" wire:model.live="governorateId" class="form-control border-primary"
                id="governorate_id">
                <option value="" selected>{{ __('static.global.select') }}</option>
                @foreach ($governorates as $governorate)
                    <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                @endforeach
            </select>
            @error('governorate_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="user_city">{{ __('static.users.city') }}</label>
            <select name="city_id" wire:model.live="cityId" class="form-control border-primary" id="city_id">
                <option value="" selected>{{ __('static.global.select') }}</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
