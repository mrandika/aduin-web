@extends('layouts.admin.app')
@extends('layouts.admin.dashboardNav')

@section('statisticActive')
active
@endsection

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="summary mb-4">
            <div class="summary-info">
                <h4>{{ ($count['finished'] ?? 0 / $count['handled'] ?? 0)*100 }}%</h4>
                <div class="text-muted">Total Ketuntasan</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Unhandled Reports</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['unhandled'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Handled Reports</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['handled'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Finished Reports</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['finished'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Reports</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['total'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
