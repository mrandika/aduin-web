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
        <div class="article-category"><a href="#">Status: {{ $item->status }}</a>
            <div class="bullet"></div> <a href="#">5 Days</a>
        </div>
    </div>
</article>
@empty
Belum ada laporan ...
@endforelse
