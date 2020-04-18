<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Judul Laporan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $item)
                    <tr id="report_{{ $item->id }}">

                        <input type="hidden" id="report_{{ $item->id }}_content" value="{{ $item->content }}"></input>
                        <input type="hidden" id="report_{{ $item->id }}_recepient" value="{{ $item->unit->name ?? $item->instance->name }}"></input>

                        <th scope="row">RPT-{{ $item->id }}{{ $item->user->id }}</th>
                        <td id="report_{{ $item->id }}_title">{{ $item->title }}</td>
                        @switch($state)
                        @case('unhandled')
                        <td class="status_badge"><a href="#" class="badge badge-danger" id="report_{{ $item->id }}_status">Unhandled</a></td>
                        @break
                        @case('handled')
                        <td class="status_badge"><a href="#" class="badge badge-warning" id="report_{{ $item->id }}_status">Handled</a></td>
                        @break
                        @case('finished')
                        <td class="status_badge"><a href="#" class="badge badge-info" id="report_{{ $item->id }}_status">Resolved</a></td>
                        @break
                        @default

                        @endswitch
                        <td><a href="#" class="badge badge-light"
                                id="report_{{ $item->id }}_date">@ymddate($item->created_at)</a></td>
                        <td><a href="javascript:void(0)" class="btn btn-primary update_report" data-id="{{ $item->id }}"
                                data-toggle="modal" data-target="#updateModal">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('admin-js')
<script>
    $(document).ready(function () {

        $('.update_report').on('click', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#report_id').val(id);

            var recepient = $('#report_' + id + '_recepient').val();
            var title = $('#report_' + id + '_title').text();
            var content = $('#report_' + id + '_content').val();
            var status_badge = $('.status_badge').html();

            $('#recepient_update_form').text(recepient);
            $('#title_update_form').text(title);
            $('#content_update_form').html(content);
            $('#status_update_form').html(status_badge);
        });
    });

</script>
@endpush
