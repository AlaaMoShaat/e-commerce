@extends('layouts.dashboard.app')
<title>{{ __('static.faqs.title') }}</title>

@push('css')
@endpush

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.faqs.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.faqs.title'), 'url' => ''],
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
                        <a data-toggle="modal" data-target="#add-faq" type="button" href="#"
                            class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.faqs.create_new_faq') }}</a>
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

                            <div class="col-xl-12 col-lg-12">
                                <div class="mb-1">
                                    <h5 class="mb-0">{{ __('static.faqs.title') }}</h5>
                                </div>
                                <div class="card faq-row" id="headingCollapse51">
                                    @forelse ($faqs as $faq)
                                        <div id="faq_{{ $faq->id }}">
                                            <div role="tabpanel" class="card-header border-success">
                                                <a data-toggle="collapse" id="question_{{ $faq->id }}"
                                                    href="#collapse_{{ $faq->id }}" aria-expanded="true"
                                                    aria-controls="collapse51_{{ $faq->id }}"
                                                    class="font-medium-1 success">{{ $faq->question }}</a>

                                                <a href="" data-url="{{ route('dashboard.faqs.destroy', $faq->id) }}"
                                                    data-message="{{ __('messages.delete_confirmation') }}"
                                                    data-title="{{ __('static.global.sure') }}"
                                                    data-item_id="faq_{{ $faq->id }}"
                                                    onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)"><i
                                                        class="la la-trash float-right"></i></a>

                                                <a data-target="#edit-faq-{{ $faq->id }}" data-toggle="modal"
                                                    href=""><i class="la la-edit float-right"></i></a>
                                            </div>
                                            <div id="collapse_{{ $faq->id }}" role="tabpanel"
                                                aria-labelledby="headingCollapse51"
                                                class="card-collapse collapse @if ($loop->index == 0) show @endif"
                                                aria-expanded="true">
                                                <div class="card-body">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                        @include('dashboard.faqs._edit')
                                    @empty
                                        <div class="alert alert-info text-center no_faqs">
                                            {{ __('static.faqs.no_faqs') }}
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.faqs._create')
    </section>
    <!-- DOM - jQuery events table -->
@endsection

@push('js')
    <script>
        $('#create-faq').on('submit', function(e) {
            e.preventDefault();
            var local = "{{ app()->getLocale() }}";
            $.ajax({
                url: "{{ route('dashboard.faqs.store') }}",
                method: 'post',
                _token: $('meta[name="csrf-token"]').attr('content'),
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $('.no_faqs').hide();
                        $('#error-list').empty();
                        $('#error-div').hide();
                        $('#create-faq')[0].reset();
                        $('#add-faq').modal('hide');
                        $(".toster_success").text(data.message).fadeIn().delay(3000).fadeOut();

                        var question = local == 'en' ? data.faq.question.en : data.faq.question.ar;
                        var answer = local == 'en' ? data.faq.answer.en : data.faq.answer.ar;
                        var faqId = data.faq.id;

                        $('.faq-row').prepend(`
                            <div role="tabpanel" class="card-header border-success">
                                <a data-toggle="collapse" href="#collapse${faqId}"
                                    aria-expanded="true" aria-controls="collapse${faqId}"
                                    class="font-medium-1 success">
                                    ${question}
                                </a>
                                <a href="#"><i class="la la-trash float-right"></i></a>
                                <a href="#"><i class="la la-edit float-right"></i></a>
                            </div>
                            <div id="collapse${faqId}" role="tabpanel"
                                aria-labelledby="headingCollapse${faqId}"
                                class="card-collapse collapse"
                                aria-expanded="true">
                                <div class="card-body">
                                    ${answer}
                                </div>
                            </div>
                    `);
                    }
                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        var errors = data.responseJSON.errors;

                        $('#error-list').empty();
                        $.each(errors, function(index, value) {
                            $('#error-list').append(`<li>${value[0]}</li>`);
                        });
                        $('#error-div').show();
                    }
                }
            });
        });


        $('.update-faq').on('submit', function(e) {
            e.preventDefault();
            var local = "{{ app()->getLocale() }}";
            var faq_id = $(this).attr('faq-id');
            var formData = new FormData(this);
            formData.append('_method', 'PUT');
            $.ajax({
                url: "{{ route('dashboard.faqs.update', ':id') }}".replace(':id', faq_id),
                method: 'post',
                _token: $('meta[name="csrf-token"]').attr('content'),
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if (data.status == 'success') {

                        $('#error-list-edit-' + faq_id).empty();
                        $('#error-div-edit-' + faq_id).hide();
                        $('#edit-faq-modal').modal('hide');
                        $(".toster_success").text(data.message).fadeIn().delay(3000).fadeOut();
                        $('#edit-faq-' + faq_id).modal('hide');

                        var question = local == 'en' ? data.faq.question.en : data.faq.question.ar;
                        var answer = local == 'en' ? data.faq.answer.en : data.faq.answer.ar;
                        $('#question_' + faq_id).text(question);
                        $('#collapse_' + faq_id).find('.card-body').text(answer);
                        $('#question_' + faq_id).removeClass('success').addClass('danger');
                    }
                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        var errors = data.responseJSON.errors;
                        $('#error-list-edit-' + faq_id).empty();
                        $.each(errors, function(index, value) {
                            $('#error-list-edit-' + faq_id).append(`<li>${value}</li>`);
                        });
                        $('#error-div-edit-' + faq_id).show();
                    }
                }
            });
        });
    </script>
@endpush
