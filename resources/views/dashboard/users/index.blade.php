@extends('layouts.dashboard.app')
<title>{{ __('static.users.title') }}</title>

@push('css')
@endpush

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.users.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.users.title'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <!-- DOM - jQuery events table -->
    <section id="language">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a data-toggle="modal" data-target="#add-user" type="button" href="#"
                            class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.users.create_new_user') }}</a>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            @include('dashboard.includes.toster-error')
                            @include('dashboard.includes.toster-success')
                            <table id="dataTable" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.users.name') }}</th>
                                        <th>{{ __('static.global.email') }}</th>
                                        <th>{{ __('static.global.email_verified_at') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.users.country') }}</th>
                                        <th>{{ __('static.users.govrnorate') }}</th>
                                        <th>{{ __('static.users.city') }}</th>
                                        <th>{{ __('static.users.num_of_orders') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.users.name') }}</th>
                                        <th>{{ __('static.global.email') }}</th>
                                        <th>{{ __('static.global.email_verified_at') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.users.country') }}</th>
                                        <th>{{ __('static.users.govrnorate') }}</th>
                                        <th>{{ __('static.users.city') }}</th>
                                        <th>{{ __('static.users.num_of_orders') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.users._create')
    </section>
    <!-- DOM - jQuery events table -->
@endsection

@push('js')
    <script>
        pdfMake.fonts = {
            Amiri: {
                normal: "{{ asset('fonts/Amiri/Amiri-Regular.ttf') }}",
                bold: "{{ asset('fonts/Amiri/Amiri-Bold.ttf') }}",
                italics: "{{ asset('fonts/Amiri/Amiri-Italic.ttf') }}",
                bolditalics: "{{ asset('fonts/Amiri/Amiri-BoldItalic.ttf') }}"
            }
        };
        var lang = "{{ app()->getLocale() }}"
        $('#dataTable').DataTable({
            language: lang == 'ar' ? {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/ar.json',
                emptyTable: "لا توجد بيانات متاحة في الجدول",
                zeroRecords: "لم يتم العثور على سجلات",
                info: "عرض _START_ إلى _END_ من _TOTAL_ سجل",
                infoEmpty: "يعرض 0 إلى 0 من 0 سجل",
                infoFiltered: "(تم تصفيته من _MAX_ إجمالي السجلات)"
            } : {
                emptyTable: "No data available in table",
                zeroRecords: "No matching records found",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)"
            },
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            var detailsForText = @json(__('static.global.details_for'));
                            return detailsForText + ' ' + data['name'] + ' (' + data['created_at'] +
                                ')';
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            fixedHeader: true,
            colReorder: true,
            select: true,
            processing: true,
            serverSide: true,
            // scroller: true,
            // scrollY: 200,
            ajax: "{{ route('dashboard.users.all') }}",
            rowId: function(row) {
                return `user_${row.id}`;
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'email_verified_at',
                    name: 'email_verified_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'governorate',
                    name: 'governorate'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'num_of_orders',
                    name: 'num_of_orders'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            dom: 'Bfrtip', // تمكين الأزرار
            buttons: [{
                    extend: 'copyHtml5',
                    text: 'نسخ',
                    exportOptions: {
                        columns: ':visible', // الأعمدة الظاهرة فقط
                        modifier: {
                            page: 'current' // البيانات في الصفحة الحالية فقط
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'تصدير Excel',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'تصدير PDF',
                    customize: function(doc) {
                        doc.defaultStyle = {
                            font: 'Amiri', // الخط المخصص إذا لزم الأمر
                            alignment: 'right'
                        };
                        doc.styles.tableHeader = {
                            alignment: 'right',
                            font: 'Amiri',
                            bold: true
                        };
                    },
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                'colvis' // زر إظهار/إخفاء الأعمدة
            ]
        });

        $('#create-user').on('submit', function(e) {
            e.preventDefault();
            var currentPage = $('#dataTable').DataTable().page();
            $.ajax({
                url: "{{ route('dashboard.users.store') }}",
                method: 'post',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $('#error-list').empty();
                        $('#error-div').hide();
                        $('#create-user')[0].reset();
                        $('#dataTable').DataTable().page(currentPage).draw(false);
                        $('#add-user').modal('hide');
                        $(".toster_success").text(data.message).show();

                        setTimeout(function() {
                            $(".toster_success, .toster_error").hide();
                        }, 3000);
                    }
                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        var errors = data.responseJSON.errors;
                        $('#error-list').empty();
                        $.each(errors, function(index, value) {
                            $('#error-list').append(`<li>${value}</li>`);
                        });
                        $('#error-div').show();
                    }
                }
            });
        });
    </script>
@endpush
