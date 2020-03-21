@foreach ($contents as $item)
<article class="article article-style-c">
    <div class="article-details">
        <div class="article-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png">
            <div class="article-user-details">
                <div class="user-detail-name">
                    <a href="#">Hasan Basri</a>
                </div>
                <div class="text-job">Web Developer</div>
            </div>
        </div>
        <div class="article-title">
            <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
        </div>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
        <div class="article-category"><a href="#">News</a>
            <div class="bullet"></div> <a href="#">5 Days</a>
        </div>
    </div>
</article>
@endforeach