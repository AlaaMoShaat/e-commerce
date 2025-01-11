@extends('layouts.dashboard.app')
<title>{{ __('static.admins.title') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.admins.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.admins.title'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('dashboard.admins.create') }}" type="button"
                        class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.admins.create_new_admin') }}</a>
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
                        <div style="min-height: 200px" class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.admins.admin_name') }}</th>
                                        <th>{{ __('static.admins.role') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.global.email') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($admins as $admin)
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
                                        <tr class="{{ $randomColor }} bg-lighten-4">
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td style="text-align: center">{{ $admin->name }}</td>
                                            <td style="text-align: center">{{ $admin->authorization->role }}
                                            </td>
                                            <td style="text-align: center">
                                                <p style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
                                                    class="@if ($admin->status == 'active') btn-success  @else btn-danger @endif">
                                                    {{ $admin->status == 'active' ? __('static.status.active') : __('static.status.inactive') }}
                                                </p>
                                            </td>
                                            <td style="text-align: center">{{ $admin->email }}</td>
                                            <td style="text-align: center">
                                                {{ $admin->created_at->format('Y-m-d h:m a') }}</td>

                                            <td style="text-align: center">
                                                <div class="dropdown float-md-lift">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('static.actions.title') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                                            style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.admins.edit', $admin->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>
                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            onclick="confirmDelete(event, 'delete_admin_{{ $admin->id }}', this.dataset.message)"
                                                            data-message='{{ __('messages.delete_confirmation') }}'><i
                                                                class="la la-trash"></i>{{ __('static.actions.delete') }}</a>

                                                        <form style="display: none" id="delete_admin_{{ $admin->id }}"
                                                            action="{{ route('dashboard.admins.destroy', $admin->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>

                                                        <a style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.admins.changeStatus', $admin->id) }}"><i
                                                                class="la @if ($admin->status == 'active') la-stop @else la-play @endif"></i>
                                                            {{ __('static.actions.change_status') }}</a>

                                                        <div class="dropdown-divider"></div><a style="padding: 3px"
                                                            class="dropdown-item" href="#"><i class="la la-cog"></i>
                                                            Settings</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="alert alert-info" colspan="7"> No Admins</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
