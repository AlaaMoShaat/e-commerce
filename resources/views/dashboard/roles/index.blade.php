@extends('layouts.dashboard.app')
<title>{{ __('static.global.roles') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.global.roles'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.global.roles'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('dashboard.roles.create') }}" type="button"
                        class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.authorization.create_new_role') }}</a>
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
                                        <th>{{ __('static.global.roles') }}</th>
                                        <th>{{ __('static.authorization.permassions') }}</th>
                                        <th>{{ __('static.authorization.related_admins') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($authorizations as $authorization)
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
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $authorization->role }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('static.authorization.permassions') }}
                                                        ({{ count($authorization->permession) }})
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdownMenuButton"
                                                        style="max-height: 200px; overflow-y: auto; width: 200px;">
                                                        @foreach ($authorization->permession as $permession)
                                                            <a class="dropdown-item"
                                                                href="javascript:void()">{{ __('permessions.' . $permession) }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $authorization->admins->count() }}</td>
                                            <td>{{ $authorization->created_at->format('Y-m-d h:m a') }}</td>
                                            <td>
                                                <div class="dropdown float-md-lift">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('static.actions.title') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                                            style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.roles.edit', $authorization->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>
                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            onclick="confirmDelete(event, 'delete_role_{{ $authorization->id }}', this.dataset.message)"
                                                            data-message='{{ __('messages.delete_confirmation') }}'><i
                                                                class="la la-trash"></i>{{ __('static.actions.delete') }}</a>

                                                        <form style="display: none"
                                                            id="delete_role_{{ $authorization->id }}"
                                                            action="{{ route('dashboard.roles.destroy', $authorization->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>

                                                        <a style="padding: 3px" class="dropdown-item" href="#"><i
                                                                class="la la-play"></i>
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
                                            <td class="alert alert-info" colspan="6"> No authorizations</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $authorizations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
