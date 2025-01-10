@extends('layouts.dashboard.app')
<title>{{ __('static.authorization.edit_role') }}</title>

@section('content')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.authorization.edit_role'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.global.roles'), 'url' => route('dashboard.roles.index')],
            ['title' => __('static.authorization.edit_role'), 'url' => ''],
        ],
    ])

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.authorization.edit_role') }}
                </h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            @include('dashboard.includes.validations')
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST" class="form">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput1">{{ __('static.authorization.role_name_en') }}</label>
                                        <input value="{{ $role->getTranslation('role', 'en') }}" type="text"
                                            id="userinput1" class="form-control border-primary"
                                            placeholder="{{ __('static.authorization.role_name_en') }}" name="role[en]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput1">{{ __('static.authorization.role_name_ar') }}</label>
                                        <input value="{{ $role->getTranslation('role', 'ar') }}" type="text"
                                            id="userinput1" class="form-control border-primary"
                                            placeholder="{{ __('static.authorization.role_name_ar') }}" name="role[ar]">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ __('static.authorization.select_permassions') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <fieldset>
                                                <input id="select-all" type="checkbox">
                                                <label for="select-all">{{ __('static.global.select_all') }}</label>
                                            </fieldset>
                                            <div class="row skin skin-line">
                                                @foreach (__('permessions') as $permessionKey => $permession)
                                                    <div class="col-3">
                                                        <fieldset>
                                                            <input @checked(in_array($permessionKey, $role->permession)) class="permession-checkbox"
                                                                value="{{ $permessionKey }}" name="permessions[]"
                                                                type="checkbox" id="input-{{ $loop->iteration }}">
                                                            <label
                                                                for="input-{{ $loop->iteration }}">{{ $permession }}</label>
                                                        </fieldset>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ __('static.actions.edit') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.permession-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
