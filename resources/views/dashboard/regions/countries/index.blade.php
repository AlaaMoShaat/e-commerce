@extends('layouts.dashboard.app')
<title>{{ __('static.regions.countries') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.regions.countries'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.regions.countries'), 'url' => ''],
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
                            <a href="{{ route('dashboard.countries.create') }}" type="button"
                                class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.regions.create_new_country') }}</a>
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
                                        <th>{{ __('static.regions.country_name') }}</th>
                                        <th>{{ __('static.regions.governorates') }}</th>
                                        <th>{{ __('static.global.users') }}</th>
                                        <th>{{ __('static.regions.country_code') }}</th>
                                        <th>{{ __('static.regions.phone_code') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <style>
                                    th {
                                        text-align: center
                                    }
                                </style>
                                <tbody>
                                    @forelse ($countries as $country)
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
                                        <tr id="country_{{ $country->id }}" class="{{ $randomColor }} bg-lighten-4">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a style="padding: 3px" class="dropdown-item"
                                                    href="{{ route('dashboard.countries.show', $country->id) }}">
                                                    {{ $country->name }} <i
                                                        class="flag-icon flag-icon-{{ $country->iso_code }}"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a style="padding: 3px" class="dropdown-item"
                                                    href="{{ route('dashboard.countries.show', $country->id) }}">
                                                    <div class="badge badge-pill badge-border border-success success">
                                                        {{ $country->governorates_count }}
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a style="padding: 3px" class="dropdown-item" href="">
                                                    <div class="badge badge-pill badge-border border-info info">
                                                        {{ $country->users_count }}
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{ $country->iso_code }}
                                            </td>
                                            <td>{{ $country->phone_code }}</td>
                                            <td>
                                                <p style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
                                                    id="status_{{ $country->id }}"
                                                    class="@if (($country->status == 'active') == 'active') btn-success  @else btn-danger @endif">
                                                    {{ $country->status == 'active' ? __('static.status.active') : __('static.status.inactive') }}
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
                                                            href="{{ route('dashboard.countries.edit', $country->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>
                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            data-url="{{ route('dashboard.countries.destroy', $country->id) }}"
                                                            data-message="{{ __('static.regions.delete_country_msg') }}"
                                                            data-title="{{ __('static.global.sure') }}"
                                                            data-item_id="country_{{ $country->id }}"
                                                            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
                                                            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
                                                        </a>

                                                        <a style="padding: 3px" class="dropdown-item change_status"
                                                            data-id="{{ $country->id }}"
                                                            data-url = "{{ route('dashboard.countries.changeStatus', $country->id) }}"
                                                            data-status_active="{{ __('static.status.active') }}"
                                                            data-status_inactive="{{ __('static.status.inactive') }}"
                                                            onclick="changeStatus(event,
                                                                                    this.dataset.id, this.dataset.url,
                                                                                    this.dataset.status_active,
                                                                                    this.dataset.status_inactive)"
                                                            href="javascript:void(0)">
                                                            <i
                                                                class="la @if ($country->status == 'active') la-stop @else la-play @endif"></i>
                                                            {{ __('static.actions.change_status') }}
                                                        </a>

                                                        <div class="dropdown-divider"></div>
                                                        <a style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.countries.show', $country->id) }}"><i
                                                                class="la la-eye"></i>
                                                            {{ __('static.regions.show_country') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <style>
                                            td {
                                                text-align: center
                                            }
                                        </style>
                                    @empty
                                        <tr>
                                            <td class="alert alert-info" colspan="8"> No Countries</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $countries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
