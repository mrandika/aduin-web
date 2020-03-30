@forelse ($contents as $item)
<article class="article article-style-c">
    <div class="article-details">
        <div class="article-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png">
            <div class="article-user-details">
                <div class="user-detail-name">
                    <a href="#">{{ $item->user->first_name }} {{ $item->user->last_name }}</a>
                </div>
                <div class="text-job">@ymddate($item->created_at), Diajukan ke
                    {{ $item->unit->name ?? $item->instance->name }}</div>
            </div>
        </div>
        <div class="article-title">
            <h2><a href="#">{{ $item->title }}</a></h2>
        </div>
        <p>{{ $item->content }} </p>

        <div class="row text-center">
            <div class="col-md-3">
                <div class="article-category float-right"><a href="#">Status: {{ $item->status }}</a>
                    <div class="bullet"></div> <a href="#">5 Days</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="article-category"><a href="#">{{ $item->actions_count }} Aksi</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="article-category"><a href="#">{{ $item->comments_count }} Komentar</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="article-category"><a href="#">{{ $item->supports_count }} Dukungan</a>
                </div>
            </div>
        </div>
    </div>
</article>
@empty
Belum ada laporan ...
@endforelse
