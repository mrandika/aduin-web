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
            <h1>Beranda Laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/">Home</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-8">

                    @auth
                    <x-card>

                        <form id="report_form">
                            @csrf
                            <div class="form-group">
                                <label>Judul</label>
                                <input class="form-control" type="text" name="title">
                            </div>
                            <div class="form-group">
                                <label>Konten</label>
                                <textarea class="summernote" name="content">
                                    <div id="location">
                                        <input type="hidden" id="lat">
                                        <input type="hidden" id="lng">
                                    </div>
                                </textarea>
                            </div>
                            <div class="form-group" id="select_unit">
                                <label class="form-label">Pilih Unit</label>
                                <div class="selectgroup w-100">
                                    <select class="select2 w-100" name="instance_id">
                                        @foreach ($instances as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>

                        <a href="javascript:void(0)" id="send_report" class="btn btn-primary float-right"><i
                                class="far fa-paper-plane"></i> Kirim</a>
                    </x-card>
                    @endauth

                    <x-content-cards :contents="$reports" />
                </div>

                <div class="col-md-4">
                    <x-card header="Laporan Selesai Terbaru" footer="">
                        @forelse ($finishnew as $item)
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img class="rounded-circle mr-3"
                                src="{{ $item->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}"
                                width="10%"><a href="{{ route('report.show', $item->id) }}">{{ $item->title }}</a></li>
                        </ul>
                        @empty
                        <ul class="list-group">
                            <li class="list-group-item">Belum Ada Laporan Selesai</li>
                        </ul>
                        @endforelse
                    </x-card>
                </div>
            </div>

        </div>
        <div class="float-right">
            <nav>
                <ul class="pagination">
                    {{ $reports->links() }}
                </ul>
            </nav>
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
                    <label>Judul</label>
                    <input class="form-control" type="text" name="title" id="title_update_form">
                </div>

                <div class="form-group">
                    <label>Konten</label>
                    <textarea class="summernote" name="content" id="content_update_form"></textarea>
                </div>
                <input type="hidden" name="id" id="report_id">
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_button">Save changes</button>
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
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                $("#lat").val(position.coords.latitude);
                $('#lng').val(position.coords.longitude);
            });
        } else {
            console.log("Browser doesn't support geolocation!");
        }

        $('#send_report').on('click', function () {
            var form = $('#report_form').serialize();

            $.ajax({
                type: "POST",
                url: "{{ url('user/report/store') }}",
                data: form,
                success: function () {
                    window.location.reload(false);
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
