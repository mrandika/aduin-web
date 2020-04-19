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
                                            <h4>Pelapor</h4>
                                        </div>
                                        <div class="ticket-desc">
                                            <div>{{ $report->user->first_name }} {{$report->user->last_name}}</div>
                                        </div>
                                    </div>
                                    <div class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Ditujukan Ke</h4>
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
                                                        id="report_{{ $report->id }}_status">Unhandled</a></td>
                                                @break
                                                @case(1)
                                                <td class="status_badge"><a href="#" class="badge badge-warning"
                                                        id="report_{{ $report->id }}_status">Belum Konfirmasi</a></td>
                                                @break
                                                @case(2)
                                                <td class="status_badge"><a href="#" class="badge badge-info"
                                                        id="report_{{ $report->id }}_status">Dalam Pengerjaan</a></td>
                                                @break
                                                @case(3)
                                                <td class="status_badge"><a href="#" class="badge badge-info"
                                                        id="report_{{ $report->id }}_status">Masalah Selesai</a></td>
                                                @break
                                                @default

                                                @endswitch
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ticket-description">
                                        <p>{{ $report->content }}</p>

                                        <div class="ticket-divider">

                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Komentar</h4>
                                            </div>
                                            @foreach ($report->comments as $comment)
                                            <div class="card-body" id="report_comment_{{ $comment->id }}">
                                                <div class="media">
                                                    <img class="rounded-circle mr-3"
                                                        src="{{ $comment->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}"
                                                        width="10%">
                                                    <div class="media-body">
                                                        <h6 class="mt-0">{{ $comment->user->first_name }}
                                                            {{ $comment->user->last_name }}</h6>
                                                        {!! $comment->content !!}
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Lainnya
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Edit</a>
                                                            <a class="dropdown-item delete_comment"
                                                                data-id="{{ $comment->id }}"
                                                                href="javascript:void(0)">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="ticket-form">
                                            @auth
                                            <form id="comment_form">
                                                @csrf
                                                <input name="report_id" type="hidden" value="{{ $report->id }}">
                                                <div class="form-group">
                                                    <textarea class="summernote form-control" name="content"></textarea>
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

        $('.delete_comment').on('click', function () {
            var id = $(this).data('id');

            $.ajax({
                type: "DELETE",
                url: "{{ url('user/report/comment/delete') }}" + '/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    $('#report_comment_' + id).fadeOut("normal", function () {
                        $('#report_comment_' + id).remove()
                    });
                },
                error: function (data) {
                    swal('Komentar gagal dihapus.', {
                        buttons: false,
                        timer: 2000,
                    });
                }
            });
        });
    });

</script>
@endpush
