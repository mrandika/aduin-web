@extends('layouts.app')
@extends('layouts.dashboardItem')
@extends('layouts.dashboardNav')

@push('css')
<link rel="stylesheet" href="{{ url('assets/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/select2/dist/css/select2.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tickets</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Tickets</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Help Your Customer</h2>
            <p class="section-lead">
                Some customers need your help.
            </p>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tickets</h4>
                        </div>
                        <div class="card-body">
                            <a href="#" class="btn btn-primary btn-icon icon-left btn-lg btn-block mb-4 d-md-none"
                                data-toggle-slide="#ticket-items">
                                <i class="fas fa-list"></i> All Tickets
                            </a>
                            <div class="tickets">
                                <div class="ticket-items" id="ticket-items">
                                    <div class="ticket-item active">
                                        <div class="ticket-title">
                                            <h4>Dibuat Oleh</h4>
                                        </div>
                                        <div class="ticket-desc">
                                            <div>{{ $report->user->first_name }} {{$report->user->last_name}}</div>
                                        </div>
                                    </div>
                                    <div class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Ditujukan untuk</h4>
                                        </div>
                                        <div class="ticket-desc">
                                            @if ($report->unit)
                                            <div>{{ $report->unit->name }}</div>
                                            @endif
                                            @if ($report->instance)
                                            <div>{{ $report->instance->name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Dibuat pada tanggal</h4>
                                        </div>
                                        <div class="ticket-desc">
                                            <div>@ymddate($item->created_at)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-content">
                                    <div class="ticket-header">
                                        <div class="ticket-sender-picture img-shadow">
                                            <img src="assets/img/avatar/avatar-5.png" alt="image">
                                        </div>
                                        <div class="ticket-detail">
                                            <div class="ticket-title">
                                                <h4>{{ $report->title }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div class="font-weight-600">{{ $report->user->first_name }}
                                                    {{$report->user->last_name}}</div>
                                                <div class="bullet"></div>
                                                @if ($report->unit)
                                                <div class="text-job">@ymddate($item->created_at), Diajukan ke
                                                    {{ $report->unit->name }}</div>
                                                @endif

                                                @if ($report->instance)
                                                <div class="text-job">@ymddate($item->created_at), Diajukan ke
                                                    {{ $report->instance->name }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ticket-description">
                                        <p>{{ $report->content }}</p>

                                        <div class="ticket-divider"></div>

                                        <div class="ticket-form">
                                          @auth
                                            <form id="comment_form">
                                              @csrf
                                                <input name="report_id" type="hidden" value="{{ $report->id }}">
                                                <div class="form-group">
                                                    <textarea class="summernote form-control" name="content"></textarea>
                                                </div>
                                                <div class="form-group text-right">
                                                  <a href="javascript:void(0)" id="send_comment" class="btn btn-primary float-right"><i
                                                    class="far fa-paper-plane"></i> Kirim </a>
                                                </div>
                                            </form>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js-lib')
<script src="{{ url('assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{ url('assets/modules/select2/dist/js/select2.js') }}"></script>
<script src="{{ url('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush

@push('js')
<script>
    $(document).ready(function () {
        $('#send_comment').on('click', function () {
            var form = $('#comment_form').serialize();

            $.ajax({
                type: "POST",
                url: "{{ url('user/report/comment/store') }}",
                data: form,
                success: function () {
                    swal('Okehhhhhhhh', {
                        buttons: false,
                        timer: 2000,
                    });
                },
                error: function (data) {
                    console.log(data);
                    swal('Gagal! Laporan gagal dibuat.', {
                        buttons: false,
                        timer: 2000,
                    });
                }
            });
        });
    });

</script>
@endpush