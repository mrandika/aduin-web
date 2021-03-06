@extends('layouts.handler.app')
@extends('layouts.handler.dashboardNav')

@switch($data)
@case('unhandled')
@section('unhandledActive')
active
@endsection
@break
@case('handled')
@section('handledActive')
active
@endsection
@break
@case('finished')
@section('resolvedActive')
active
@endsection
@break
@default

@endswitch

@push('handler-css')
<link rel="stylesheet" href="{{ url('assets/modules/select2/dist/css/select2.min.css') }}">
@endpush

@section('handler-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@switch($data)
                @case('unhandled')
                Unhandled Reports
                @break
                @case('handled')
                Handled Reports
                @break
                @case('finished')
                Finished Reports
                @break
                @default

                @endswitch</h1>
        </div>

        <x-list-report :contents="$reports" :state="$data" />
    </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="updateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Status Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Ditujukan Ke</label>
                    <p id="recepient_update_form"></p>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <p id="title_update_form"></p>
                </div>

                <div class="form-group">
                    <label>Konten</label>
                    <p id="content_update_form"></p>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <p id="status_update_form"></p>
                </div>

                <input type="hidden" name="id" id="report_id">

                @if ($data == 'unhandled')
                <form id="report_form">
                    @csrf
                    <div class="form-group">
                        <label>Petugas Penanganan</label>
                        <div class="selectgroup w-100">
                            <select class="select2 form-control" name="handlers[]" multiple="multiple"
                                style="width: 100%;">
                                @foreach ($handlers as $item)
                                <option value="{{ $item->id }}">{{ $item->user->first_name }}
                                    {{ $item->user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="report_id" id="form_report_id">
                </form>
                @endif

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_modal">Close</button>
                {{-- <button type="button" class="btn btn-danger" id="delete_button">Hapus Laporan</button> --}}
                @if ($data == 'unhandled')
                <button type="button" class="btn btn-primary" id="store_handler_button">Save changes</button>
                @else
                <button href="javascript:void(0)" class="btn btn-primary" id="show_report_button">Buka Laporan</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('handler-js-lib')
<script src="{{ url('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('handler-js')
<script>
    $(document).ready(function () {
        $('#show_report_button').on('click', function (e) {
            e.preventDefault();

            var id = $('#report_id').val();
            window.location.href = "{{ url('handler/report/show') }}" + '/' + id;
        });
    });

</script>
@endpush
