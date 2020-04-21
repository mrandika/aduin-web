@extends('layouts.handler.app')
@extends('layouts.handler.dashboardNav')

@push('handler-css')
<link rel="stylesheet" href="{{ url('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@section('handler-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Laporan</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tickets</h4>
                    </div>
                    <div class="card-body">
                        <div class="tickets">
                            <div class="ticket-content w-100">
                                <div class="ticket-header">
                                    <div class="ticket-sender-picture img-shadow">
                                        <img src="{{ $report->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}"
                                            alt="image">
                                    </div>
                                    <div class="ticket-detail">
                                        <div class="ticket-title">
                                            <h4>{{ $report->title }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div class="font-weight-600">{{ $report->user->first_name }}
                                                {{$report->user->last_name}}</div>
                                            <div class="bullet"></div>
                                            @switch($report->status)
                                            @case(0)
                                            <td class="status_badge"><a href="#" class="badge badge-danger"
                                                    id="report_{{ $report->id }}_status">Laporan Dinonaktifkan</a></td>
                                            @break
                                            @case(1)
                                            <td class="status_badge"><a href="#" class="badge badge-warning"
                                                    id="report_{{ $report->id }}_status">Menunggu Konfirmasi</a></td>
                                            @break
                                            @case(2)
                                            <td class="status_badge"><a href="#" class="badge badge-info"
                                                    id="report_{{ $report->id }}_status">Menunggu Solusi</a></td>
                                            @break
                                            @case(3)
                                            <td class="status_badge"><a href="#" class="badge badge-success"
                                                    id="report_{{ $report->id }}_status">Laporan Selesai</a></td>
                                            @break
                                            @default

                                            @endswitch
                                        </div>
                                    </div>
                                </div>

                                <div class="ticket-description">
                                    <p>{!! $report->content !!}</p>

                                    <div class="ticket-divider">

                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Tanggapan</h4>
                                        </div>
                                        @foreach ($report->actions as $action)
                                        <div class="card-body" id="report_comment_{{ $action->id }}">
                                            <div class="media">
                                                <img class="rounded-circle mr-3"
                                                    src="{{ $action->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}"
                                                    width="10%">
                                                <div class="media-body">
                                                    <h6 class="mt-0">{{ $action->user->first_name }}
                                                        {{ $action->user->last_name }}</h6>
                                                    {!! $action->content !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ticket-divider"></div>
                                        @endforeach
                                    </div>

                                    <div class="ticket-form">
                                        @auth
                                        <form id="comment_form">
                                            @csrf
                                            <input name="report_id" type="hidden" value="{{ $report->id }}">
                                            <div class="form-group">
                                                <textarea class="form-control summernote" name="content"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <a href="javascript:void(0)" id="send_comment"
                                                    class="btn btn-primary float-right"><i
                                                        class="far fa-paper-plane"></i> Kirim </a>
                                            </div>
                                        </form>
                                        @endauth
                                    </div>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Tim Satuan Tugas</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($report->handlers as $item)
                            <li class="list-group-item">{{ $item->handler->user->first_name }}
                                {{ $item->handler->user->last_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('handler-js-lib')
<script src="{{ url('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush

@push('handler-js')
<script>
    $(document).ready(function () {
        $('#send_comment').on('click', function () {
            var form = $('#comment_form').serialize();

            $.ajax({
                type: "POST",
                url: "{{ url('handler/report/action/store') }}",
                data: form,
                success: function () {
                    window.location.reload(false);
                },
                error: function (data) {
                    console.log(data);
                    swal('Komentar gagal dibuat.', {
                        buttons: false,
                        timer: 2000,
                    });
                }
            });
        });
    });

</script>
@endpush
