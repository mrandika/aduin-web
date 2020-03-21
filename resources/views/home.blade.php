@extends('layouts.app')
@extends('layouts.dashboardItem')
@extends('layouts.dashboardNav')

@push('css')
<link rel="stylesheet" href="{{ url('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Top Navigation</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Top Navigation</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">This is Example Page</h2>
            <p class="section-lead">This page is just an example for you to create your own page.</p>

            <div class="row">
                <div class="col-md-8">
                    <x-card>
                        <textarea class="summernote"></textarea>
                    </x-card>

                    @php
                        $data = [1,1,1,1,1,1,1,1];
                    @endphp

                    <x-content-cards :contents="$data" />
                </div>

                <div class="col-md-4">
                    <x-card header="ABC" footer="DEF">
                        <p>WALL_MAGAZINE</p>
                    </x-card>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@push('js-lib')
<script src="{{ url('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush
