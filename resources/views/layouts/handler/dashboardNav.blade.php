@section('handler-dashboardNav')
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Aduin</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">Adu</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class=@yield('statisticActive')><a class="nav-link" href="{{ route('handler.home.statistic') }}"><i
                    class="far fa-square"></i> <span>Statistik</span></a></li>
        {{-- <li class=@yield('performanceActive')><a class="nav-link" href="{{ route('admin.home.performance') }}"><i
                    class="far fa-square"></i> <span>Performa</span></a></li> --}}

        <li class="menu-header">Report</li>
        <li class=@yield('handledActive')><a class="nav-link" href="{{ route('handler.report.handled') }}"><i
                    class="far fa-square"></i> <span>Terkonfirmasi</span></a></li>
        <li class=@yield('resolvedActive')><a class="nav-link" href="{{ route('handler.report.resolved') }}"><i
                    class="far fa-square"></i> <span>Selesai</span></a></li>
    </ul>
</aside>
@endsection
