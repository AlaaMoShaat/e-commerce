@extends('layouts.dashboard.app')
<title>{{ __('static.regions.governorates') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.regions.governorates'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.regions.governorates'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <a href="{{ route('dashboard.governorates.create') }}" type="button"
                                class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.regions.create_new_governorate') }}</a>
                        </div>
                        <div class="col-4">
                            <form id="country_search" action="{{ url()->current() }}" method="get"
                                class="form form-horizontal">
                                <fieldset class="form-group d-flex">
                                    <input type="text" id="search" class="form-control border-primary"
                                        placeholder="{{ __('static.global.search') }}" name="keyword">
                                    <button type="submit" style="margin-left: 5px"
                                        class="btn btn-primary btn-glow btn-min-width">{{ __('static.global.search') }}</button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @include('dashboard.includes.toster-error')
                        @include('dashboard.includes.toster-success')
                        <div style="min-height: 200px" class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.regions.governorate_name') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.regions.cities') }}</th>
                                        <th>{{ __('static.global.users') }}</th>
                                        <th>{{ __('static.global.sipping_price') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <style>
                                    th {
                                        text-align: center;
                                    }
                                </style>
                                <tbody>
                                    @forelse ($governorates as $governorate)
                                        @php
                                            $colors = [
                                                'bg-blue',
                                                'bg-light-blue',
                                                'bg-teal',
                                                'bg-cyan',
                                                'bg-indigo',
                                                'bg-purple',
                                                'bg-pink',
                                                'bg-gray',
                                                'bg-white',
                                            ];

                                            $randomColor = $colors[array_rand($colors)];
                                        @endphp
                                        <tr id="governorate_{{ $governorate->id }}"
                                            class="{{ $randomColor }} bg-lighten-4">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a style="padding: 3px" class="dropdown-item"
                                                    href="{{ route('dashboard.governorates.show', $governorate->id) }}">
                                                    {{ $governorate->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <p style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
                                                    id="status_{{ $governorate->id }}"
                                                    class="@if ($governorate->status == '1') btn-success  @else btn-danger @endif">
                                                    {{ $governorate->getStatusTranslatable() }}
                                                </p>
                                            </td>

                                            <td>
                                                <a style="padding: 3px" class="dropdown-item"
                                                    href="{{ route('dashboard.governorates.show', $governorate->id) }}">
                                                    <div class="badge badge-pill badge-border border-success success">
                                                        {{ $governorate->cities_count }}
                                                    </div>
                                                </a>
                                            </td>

                                            <td>
                                                <a style="padding: 3px" class="dropdown-item" href="">
                                                    <div class="badge badge-pill badge-border border-info info">
                                                        {{ $governorate->users_count }}
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <p style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
                                                    class="btn-success" id="price_{{ $governorate->id }}">
                                                    {{ $governorate->shippingGovernorate->price }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="dropdown float-md-lift">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('static.actions.title') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                                            style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.governorates.edit', $governorate->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>

                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            data-url="{{ route('dashboard.governorates.destroy', $governorate->id) }}"
                                                            data-message="{{ __('static.regions.delete_governorate_msg') }}"
                                                            data-title="{{ __('static.global.sure') }}"
                                                            data-item_id="governorate_{{ $governorate->id }}"
                                                            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
                                                            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
                                                        </a>

                                                        <a style="padding: 3px" class="dropdown-item change_status"
                                                            data-id="{{ $governorate->id }}"
                                                            data-url = "{{ route('dashboard.governorates.changeStatus', $governorate->id) }}"
                                                            data-lang="{{ app()->getLocale() }}"
                                                            onclick="changeStatus(event,this.dataset.id, this.dataset.url,this.dataset.lang)"
                                                            href="javascript:void(0)">
                                                            <i
                                                                class="la @if ($governorate->status == '1') la-stop @else la-play @endif"></i>
                                                            {{ __('static.actions.change_status') }}
                                                        </a>

                                                        <a style="padding: 3px" class="dropdown-item"
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#edit-price-{{ $governorate->id }}"><i
                                                                class="la la-money"></i>
                                                            {{ __('static.global.change_price') }}
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.governorates.show', $governorate->id) }}"><i
                                                                class="la la-eye"></i>
                                                            {{ __('static.regions.show_governorate') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <style>
                                            td {
                                                text-align: center;
                                            }
                                        </style>
                                        @include('dashboard.regions.governorates.change-shipping-price')
                                    @empty
                                        <tr>
                                            <td class="alert alert-info" colspan="7"> No Governorates</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $governorates->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@push('js')
    <script>
        $(document).on('submit', '.shipping-price-form', function(e) {
            e.preventDefault();

            var formData = new FormData($(this)[0]);
            var governorate_id = $(this).attr('governorate-id');

            $.ajax({
                url: "{{ route('dashboard.governorates.shipping.price', ':id') }}".replace(':id',
                    governorate_id),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {
                        $(`#edit-price-${governorate_id}`).modal('hide');
                        $(".toster_success").text(response.message).show();
                        $('#price_' + governorate_id).empty();
                        $('#price_' + governorate_id).text(response.data.shipping_governorate.price);
                    }
                },
                error: function(response) {
                    var response = $.parseJSON(response.responseText);
                    $('#error_' + governorate_id).text(response.errors.price).show();
                }
            });
        });
    </script>
@endpush
