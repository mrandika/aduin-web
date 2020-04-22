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
            <a href="/" class="btn btn-icon"><i
                class="fas fa-arrow-left"></i></a>
            <h1>Laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/">Home</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('report.show', $report->id) }}">Detail</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Laporan</h4>
                        </div>
                        <div class="card-body">
                            <div class="tickets">
                                <div class="ticket-items" id="ticket-items">
                                    <div class="ticket-item active">
                                        <div class="ticket-title">
                                            <h4>Kode Laporan</h4>
                                        </div>
                                        <div class="ticket-desc">
                                            <div>RPT-{{ $report->id }}-{{ $report->user->id }}</div>
                                        </div>
                                    </div>
                                    <div class="ticket-item">
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

                                    <div class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Status Laporan</h4>
                                        </div>
                                        <div class="ticket-desc">
                                            @switch($report->status)
                                            @case(0)
                                            <td class="status_badge"><a href="#" class="badge badge-danger"
                                                    id="report_{{ $report->id }}_status">Laporan Dinonaktifkan</a>
                                            </td>
                                            @break
                                            @case(1)
                                            <td class="status_badge"><a href="#" class="badge badge-warning"
                                                    id="report_{{ $report->id }}_status">Menunggu Konfirmasi</a>
                                            </td>
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
                                            <div class="card-body">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                            href="#home" role="tab" aria-controls="home"
                                                            aria-selected="true">Komentar <span
                                                                class="badge badge-primary badge-pill">{{ $report->comments_count }}</span></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab"
                                                            href="#profile" role="tab" aria-controls="profile"
                                                            aria-selected="false">Komentar Petugas <span
                                                                class="badge badge-primary badge-pill">{{ $report->actions_count }}</span></a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                        aria-labelledby="home-tab">
                                                        @foreach ($report->comments as $comment)
                                                        <div class="card-body" id="report_comment_{{ $comment->id }}">
                                                            <div class="media">
                                                                <img class="rounded-circle mr-3"
                                                                    src="{{ $comment->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}"
                                                                    width="10%">
                                                                <div class="media-body">
                                                                    <h6 class="mt-0">{{ $comment->user->first_name }}
                                                                        {{ $comment->user->last_name }}</h6>
                                                                        <small>@ymdtimedate($action->created_at)</small>
                                                                        <br>
                                                                    {!! $comment->content !!}
                                                                </div>
                                                                @if (Auth::id() == $comment->user->id)
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        Lainnya
                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item has-icon update_comment"
                                                                            data-id="{{ $comment->id }}"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="modal"
                                                                            data-target="#updateModal">Perbarui</a>
                                                                        <a class="dropdown-item delete_comment"
                                                                            data-id="{{ $comment->id }}"
                                                                            href="javascript:void(0)">Hapus</a>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="ticket-divider"></div>
                                                        @endforeach
                                                    </div>

                                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                                        aria-labelledby="profile-tab">
                                                        @foreach ($report->actions as $action)
                                                        <div class="card-body" id="report_comment_{{ $action->id }}">
                                                            <div class="media">
                                                                <img class="rounded-circle mr-3"
                                                                    src="{{ $action->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}"
                                                                    width="10%">
                                                                <div class="media-body">
                                                                    <h6 class="mt-0">{{ $action->user->first_name }}
                                                                        {{ $action->user->last_name }}</h6>
                                                                        <small>@ymdtimedate($action->created_at)</small>
                                                                        <br>
                                                                    {!! $action->content !!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="ticket-divider"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
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
<div class="modal fade" tabindex="-1" role="dialog" id="updateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Konten</label>
                    <textarea class="summernote" name="content" id="content_update_form"></textarea>
                </div>
                <input type="hidden" name="id" id="comment_id">
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_button">Save
                    changes</button>
            </div>
        </div>
    </div>
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

        $('.update_comment').on('click', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#comment_id').val(id);

            var title = $('#report_comment_' + id + '_title').html();
            var content = $('#report_comment_' + id + '_comment').html();

            $('#content_update_form').summernote({
                toolbar: []
            });

            $('#content_update_form').summernote('code', content);
        });

        $('#update_button').click(function (e) {
            e.preventDefault();

            var id = $('#comment_id').val();

            var content = $('#content_update_form').val();

            $.ajax({
                type: "PATCH",
                url: "{{ url('user/report/comment/update') }}" + '/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "content": content,
                },
                success: function () {
                    $('#report_comment_' + id + '_content').html(content);

                    $('#close_modal').click();
                    window.location.reload(false);
                },
                error: function (data) {
                    console.log(data);
                    swal('Gagal! Komentar gagal diperbarui.', {
                        buttons: false,
                        timer: 2000,
                    });
                }
            });
        });
    });

</script>
@endpush
