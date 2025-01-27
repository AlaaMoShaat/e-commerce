@extends('layouts.dashboard.app')
<title>{{ __('static.regions.governorates') }} | {{ $governorate->name }}</title>


@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.regions.show_governorate'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.regions.countries'), 'url' => route('dashboard.countries.index')],
            [
                'title' => $governorate->country->name,
                'url' => route('dashboard.countries.show', $governorate->country->id),
            ],
            ['title' => $governorate->name, 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div style="text-align: center">
                        <span style="font-size: 20px; color: #1ec481">
                            {{ $governorate->country->name }} | {{ $governorate->name }}</span>
                    </div>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
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
                                        <th>{{ __('static.regions.city_name') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.global.users') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>

                                    </tr>
                                </thead>
                                <style>
                                    th {
                                        text-align: center;
                                    }
                                </style>
                                @php
                                    $cities = $governorate->cities;
                                @endphp
                                <tbody>
                                    @forelse ($cities as $city)
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
                                        <tr id="city_{{ $city->id }}" class="{{ $randomColor }} bg-lighten-4">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a style="padding: 3px" class="dropdown-item"
                                                    href="{{ route('dashboard.cities.show', $city->id) }}">
                                                    {{ $city->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <p id="status_{{ $city->id }}"
                                                    style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
                                                    class="@if ($city->status == '1') btn-success  @else btn-danger @endif">
                                                    {{ $city->getStatusTranslatable() }}
                                                </p>
                                            </td>
                                            <td>
                                                <a style="padding: 3px" class="dropdown-item" href="">
                                                    <div class="badge badge-pill badge-border border-info info">
                                                        {{ $city->users->count() }}
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="dropdown float-md-lift">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('static.actions.title') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                                            style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.cities.edit', $city->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>

                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            data-url="{{ route('dashboard.cities.destroy', $city->id) }}"
                                                            data-message="{{ __('messages.delete_confirmation') }}"
                                                            data-title="{{ __('static.global.sure') }}"
                                                            data-item_id="city_{{ $city->id }}"
                                                            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
                                                            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
                                                        </a>

                                                        <a style="padding: 3px" class="dropdown-item change_status"
                                                            data-id="{{ $city->id }}"
                                                            data-url = "{{ route('dashboard.cities.changeStatus', $city->id) }}"
                                                            data-lang="{{ app()->getLocale() }}"
                                                            onclick="changeStatus(event,this.dataset.id, this.dataset.url,this.dataset.lang)"
                                                            href="javascript:void(0)">
                                                            <i
                                                                class="la @if ($city->status == '1') la-stop @else la-play @endif"></i>
                                                            {{ __('static.actions.change_status') }}
                                                        </a>

                                                        <div class="dropdown-divider"></div><a style="padding: 3px"
                                                            class="dropdown-item" href="#"><i class="la la-eye"></i>
                                                            {{ __('static.regions.show_city') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <style>
                                            td {
                                                text-align: center;
                                            }
                                        </style>
                                    @empty
                                        <tr>
                                            <td class="alert alert-info" colspan="7"> No Cities</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
