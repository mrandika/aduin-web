@push('css')
<style>
    .liked {
        background-color: #cc4b37;
        border-color: #cc4b37;
    }

    .liked .fa,
    .liked span {
        color: #fefefe;
    }

    .liked:focus {
        background-color: #cc4b37;
    }

    .liked:focus .fa,
    .liked:focus span {
        color: #fefefe;
    }

    .liked:hover {
        background-color: #cc4b37;
        border-color: #cc4b37;
    }

    .liked:hover .fa,
    .liked:hover span {
        color: #fefefe;
    }

</style>
@endpush

@forelse ($contents as $item)
<article class="article article-style-c" id="report_{{ $item->id }}">
    <div class="article-details">
        <div class="article-user">
            <img alt="image" src="{{ $item->user->photo_url ?? 'assets/img/avatar/avatar-1.png' }}">
            <div class="article-user-details">

                @auth
                <div class="dropdown d-inline float-right">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Lainnya
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                        @if (Auth::id() == $item->user->id)
                        <a class="dropdown-item has-icon delete_report" data-id="{{ $item->id }}"
                            href="javascript:void(0)"><i class="far fa-trash"></i> Hapus</a>
                        <a class="dropdown-item has-icon update_report" data-id="{{ $item->id }}"
                            href="javascript:void(0)" data-toggle="modal" data-target="#updateModal"><i
                                class="far fa-pen"></i> Perbarui</a>
                        @endif
                        <a class="dropdown-item has-icon btn-support" data-id="{{ $item->id }}"><i
                                class="far fa-thumbs-up"></i> Dukung</a>
                    </div>
                </div>
                @endauth

                <div class="user-detail-name">
                    <a href="#">{{ $item->user->first_name }} {{ $item->user->last_name }}</a>
                </div>

                @if ($item->unit)
                <div class="text-job">@ymddate($item->created_at), Diajukan ke
                    {{ $item->unit->name }}</div>
                @endif

                @if ($item->instance)
                <div class="text-job">@ymddate($item->created_at), Diajukan ke
                    {{ $item->instance->name }}</div>
                @endif
            </div>
        </div>
        <div class="article-title">
            <h2><a href="{{ route('report.show', $item->id) }}" id="report_{{ $item->id }}_title">{{ $item->title }}</a>
            </h2>
        </div>
        <p id="report_{{ $item->id }}_content">{!! $item->content !!}</p>

        <div class="row text-center">
            <div class="col-md-6">
                <div class="article-category"><a href="#">Status:
                        @switch($item->status)
                        @case(0)
                        <td class="status_badge"><a href="#" class="badge badge-danger"
                                id="report_{{ $item->id }}_status">Unhandled</a></td>
                        @break
                        @case(1)
                        <td class="status_badge"><a href="#" class="badge badge-warning"
                                id="report_{{ $item->id }}_status">Belum Konfirmasi</a></td>
                        @break
                        @case(2)
                        <td class="status_badge"><a href="#" class="badge badge-info"
                                id="report_{{ $item->id }}_status">Dalam Pengerjaan</a></td>
                        @break
                        @case(3)
                        <td class="status_badge"><a href="#" class="badge badge-info"
                                id="report_{{ $item->id }}_status">Masalah Selesai</a></td>
                        @break
                        @default

                        @endswitch
                    </a>
                    <div class="bullet"></div> <a href="#">5 Days</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="article-category"><a href="#">{{ $item->actions_count }} Aksi</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="article-category"><a href="#">{{ $item->comments_count }} Komentar</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="article-category"><a href="#">{{ $item->supports_count }} Dukungan</a>
                </div>
            </div>
        </div>
    </div>
</article>
@empty
<div class="empty-state" data-height="400">
    <div class="empty-state-icon">
        <i class="fas fa-question"></i>
    </div>
    <h2>We couldn't find any data</h2>
    <p class="lead">
        Sorry we can't find any data, to get rid of this message, make at least 1 entry.
    </p>
    <a href="#" class="btn btn-primary mt-4">Create new One</a>
    <a href="#" class="mt-4 bb">Need Help?</a>
</div>
@endforelse

@push('js')
<script>
    $(document).ready(function () {

        $('.delete_report').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "DELETE",
                url: "{{ url('user/report/delete') }}" + '/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    $("#report_" + id).fadeOut("normal", function () {
                        $("#report_" + id).remove();
                    });
                },
                error: function (data) {
                    console.log(data);
                    swal('Gagal! Laporan gagal dihapus.', {
                        buttons: false,
                        timer: 2000,
                    });
                }
            });
        });

        $('.update_report').on('click', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#report_id').val(id);

            var title = $('#report_' + id + '_title').html();
            var content = "{!! $item->content !!}";

            $('#content_update_form').summernote({
                toolbar: []
            });

            $('#title_update_form').val(title);
            $('#content_update_form').summernote('code', content);
        });

        $('#update_button').click(function (e) {
            e.preventDefault();

            var id = $('#report_id').val();

            var title = $('#title_update_form').val();
            var content = $('#content_update_form').val();

            $.ajax({
                type: "PATCH",
                url: "{{ url('user/report/update') }}" + '/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "title": title,
                    "content": content,
                },
                success: function () {
                    $('#report_' + id + '_title').html(title);
                    $('#report_' + id + '_content').html(content);

                    $('#close_modal').click();
                },
                error: function (data) {
                    console.log(data);
                    swal('Gagal! Laporan gagal diperbarui.', {
                        buttons: false,
                        timer: 2000,
                    });
                }
            });
        });

        $('.btn-support').on('click', function () {
            var id_report = $(this).data('id');

            if ($(this).hasClass('liked')) {
                $.ajax({
                    url: "{{ url('user/report/unsupport') }}" + '/' + id_report,
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('.btn-support').removeClass('liked');
                    },
                    error: function (data) {
                        swal('Laporan gagal dihapus dari dukungan.', {
                            buttons: false,
                            timer: 2000,
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "{{ url('user/report/support') }}" + '/' + id_report,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('.btn-support').addClass('liked');
                    },
                    error: function (data) {
                        swal('Laporan gagal didukung.', {
                            buttons: false,
                            timer: 2000,
                        });
                    }
                });
            }
        });
    });

</script>
@endpush
