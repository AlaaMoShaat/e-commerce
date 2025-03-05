@extends('layouts.dashboard.app')
<title>{{ __('static.products.attributes.title') }}</title>

@push('css')
@endpush

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.products.attributes.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.products.attributes.title'), 'url' => ''],
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
                        <a data-toggle="modal" data-target="#add-attribute" type="button" href="#"
                            class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.products.attributes.create_new_attribute') }}</a>
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
                                        <th>{{ __('static.products.attributes.attribute_name') }}</th>
                                        <th>{{ __('static.products.attributes.attribute_values') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.products.attributes.attribute_name') }}</th>
                                        <th>{{ __('static.products.attributes.attribute_values') }}</th>
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
        @include('dashboard.products.attributes._create')
        @include('dashboard.products.attributes._edit')
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
            ajax: "{{ route('dashboard.attributes.all') }}",
            rowId: function(row) {
                return `attribute_${row.id}`;
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
                    data: 'attributeValues',
                    name: 'attributeValues'
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

        $('#create-attribute').on('submit', function(e) {
            e.preventDefault();
            var currentPage = $('#dataTable').DataTable().page();
            $.ajax({
                url: "{{ route('dashboard.attributes.store') }}",
                method: 'post',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $('#error-list').empty();
                        $('#error-div').hide();
                        $('#create-attribute')[0].reset();
                        $('#dataTable').DataTable().page(currentPage).draw(false);
                        $('#add-attribute').modal('hide');
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

        $(document).on('click', '.attribute-edit', function(e) {
            e.preventDefault();
            $('.modal.fade.dtr-bs-modal').hide();
            $('.modal-backdrop.fade').hide();
            $('#attribute_id_edit').val($(this).data('id'));
            $('#attribute_name_ar_edit').val($(this).data('name-ar'));
            $('#attribute_name_en_edit').val($(this).data('name-en'));
            $('.attribute_values_row_edit').empty();

            let valuesRow = $('.attribute_values_row_edit:last');
            valuesRow.empty();
            $(this).data('values').forEach(value => {
                valuesRow.after(`
                     <div class="row attribute_values_row_edit">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="attribute_value_ar_${value.id}">{{ __('static.products.attributes.value_ar') }}</label>
                                <input type="text" id="attribute_value_ar_${value.id}" class="form-control border-primary"
                                    placeholder="{{ __('static.products.attributes.value_ar') }}"
                                    name="value[${value.id}][ar]" value="${value.value_ar}">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="attribute_value_en_${value.id}">{{ __('static.products.attributes.value_en') }}</label>
                                <input type="text" id="attribute_value_en_${value.id}" class="form-control border-primary"
                                    placeholder="{{ __('static.products.attributes.value_en') }}"
                                    name="value[${value.id}][en]" value="${value.value_en}">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="button" class="btn btn-danger removeValRowEdit"><i class="ft-x"></i></button>
                        </div>
                    </div>
                `);
            });
            $('#error-list-edit').empty();
            $('#error-div-edit').hide();
            $('#edit-attribute-modal').modal('show');

        });

        $('#update-attribute').on('submit', function(e) {
            e.preventDefault();
            var currentPage = $('#dataTable').DataTable().page();
            var attribute_id = $('#attribute_id_edit').val();
            var formData = new FormData(this);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'PUT');
            $.ajax({
                url: "{{ route('dashboard.attributes.update', ':id') }}".replace(':id', attribute_id),
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if (data.status == 'success') {
                        $('#error-list-edit').empty();
                        $('#error-div-edit').hide();
                        $('#dataTable').DataTable().page(currentPage).draw(false);
                        $('#edit-attribute-modal').modal('hide');
                        $(".toster_success").text(data.message).show();
                        $(".toster_success").text(data.message).fadeIn().delay(3000).fadeOut();
                    }
                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        var errors = data.responseJSON.errors;
                        $('#error-list-edit').empty();
                        $.each(errors, function(index, value) {
                            $('#error-list-edit').append(`<li>${value}</li>`);
                        });
                        $('#error-div-edit').show();
                    }
                }
            });
        });

        $(document).ready(function() {
            let valueIndex = ($('.attribute_values_row').length) + 1 || 2;

            $('#add_more_attr_vals').on('click', function(e) {
                e.preventDefault();
                let newRow = `
                    <div class="row attribute_values_row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="attribute_value_ar_${valueIndex}">{{ __('static.products.attributes.value_ar') }}</label>
                                <input type="text" id="attribute_value_ar_${valueIndex}" class="form-control border-primary"
                                    placeholder="{{ __('static.products.attributes.value_ar') }}"
                                    name="value[${valueIndex}][ar]">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="attribute_value_en_${valueIndex}">{{ __('static.products.attributes.value_en') }}</label>
                                <input type="text" id="attribute_value_en_${valueIndex}" class="form-control border-primary"
                                    placeholder="{{ __('static.products.attributes.value_en') }}"
                                    name="value[${valueIndex}][en]">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="button" class="btn btn-danger removeValRow"><i class="ft-x"></i></button>
                        </div>
                    </div>
                `;

                $('.attribute_values_row:last').after(newRow);
                valueIndex++;
            });

            $(document).on('click', '.removeValRow', function() {
                $(this).closest('.attribute_values_row').remove();
            });
        });

        $(document).ready(function() {
            let valueIndex = ($('.attribute_values_row_edit').length) + 1;

            $('#add_more_attr_vals_edit').on('click', function(e) {
                e.preventDefault();
                let newRow = `
                    <div class="row attribute_values_row_edit">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="attribute_value_ar_${valueIndex}">{{ __('static.products.attributes.value_ar') }}</label>
                                <input type="text" id="attribute_value_ar_${valueIndex}" class="form-control border-primary"
                                    placeholder="{{ __('static.products.attributes.value_ar') }}"
                                    name="value[${valueIndex}][ar]">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="attribute_value_en_${valueIndex}">{{ __('static.products.attributes.value_en') }}</label>
                                <input type="text" id="attribute_value_en_${valueIndex}" class="form-control border-primary"
                                    placeholder="{{ __('static.products.attributes.value_en') }}"
                                    name="value[${valueIndex}][en]">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="button" class="btn btn-danger removeValRowEdit"><i class="ft-x"></i></button>
                        </div>
                    </div>
                `;

                $('.attribute_values_row_edit:last').after(newRow);
                valueIndex++;
            });

            $(document).on('click', '.removeValRowEdit', function() {
                $(this).closest('.attribute_values_row_edit').remove();
            });
        });
    </script>
@endpush
