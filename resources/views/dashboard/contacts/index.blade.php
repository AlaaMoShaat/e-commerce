@extends('layouts.dashboard.app')
<title>{{ __('static.contacts.title') }}</title>


@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.contacts.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.contacts.title'), 'url' => ''],
        ],
    ])
@endsection


@section('content')
    <div class="app-content">
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="card w-100 p-3">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <!-- Contact Sidebar -->
                            <div class="col-md-3 d-none d-lg-block">
                                @livewire('dashboard.contact.contact-sidebar')
                            </div>

                            <!-- Contact Messages -->
                            <div class="col-md-5">
                                @livewire('dashboard.contact.contact-messages')
                            </div>

                            <!-- Contact Show (Message Details) -->
                            <div class="col-md-4">
                                @livewire('dashboard.contact.contact-show')
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer text-center">
                        @livewire('dashboard.contact.reply-contact')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // sweet alert after contact deleted
        document.addEventListener('livewire:init', () => {
            Livewire.on('msg-deleted', (event) => {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: event,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
        // sweet alert after contact reply
        document.addEventListener('livewire:init', () => {
            Livewire.on('reply-contact-success', (event) => {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: 'event',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
@endpush
