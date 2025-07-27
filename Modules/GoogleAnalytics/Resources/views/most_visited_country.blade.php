@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/dist/css/user-list.min.css') }}">
@endsection
@section('page_title', __('Visited Countries'))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="google-analytics-most-visited-country-list-container">
        <div class="card">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <h5>{{ __('Visited Countries') }}</h5>
            </div>
            <div class="card-body p-0 user-list-wallet user-list-processing-message" data-column="id">
                <div class="card-block pt-2 px-2">
                    <div class="col-sm-12 form-tabs px-3">
                        @include('admin.layouts.includes.yajra-data-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/dist/js/custom/yajra-export.min.js') }}"></script>
@endsection
