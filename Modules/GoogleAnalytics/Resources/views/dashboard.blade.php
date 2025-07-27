@extends('admin.layouts.app')
@section('page_title', __('Google Analytics Dashboard'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="font-weight-600 c-gray-5">{{ __('Google Analytics') }}</h5>
                    <div class="form-group mb-0">
                        <button type="button" class="form-control date-range py-2 rounded-sm" id="date-range-btn">
                            <span class="float-left">
                                <i class="fa fa-calendar"></i>
                                {{ __('Pick a date range') }}
                            </span>
                            <i class="fa fa-caret-down float-right pt-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card audience">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="font-weight-600 c-gray-5">{{ __('Audience') }}</h5>
                </div>
                <div class="card-block h-360">
                    <canvas id="audienceChart" class="d-none w-100 h-300px"></canvas>
                    <div class="placeholder wave h-300px">
                        <div class="square"></div>
                    </div>
                    <h6 class="text-secondary d-none">{{ __('No data available.') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card pageView">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="font-weight-600 c-gray-5">{{ __('Page View') }}</h5>
                </div>
                <div class="card-block h-360">
                    <canvas id="pageViewsChart" class="d-none w-100 h-300px"></canvas>
                    <div class="placeholder wave h-300px">
                        <div class="square"></div>
                    </div>
                    <h6 class="text-secondary d-none">{{ __('No data available.') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card device">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="font-weight-600 c-gray-5">{{ __('Devices') }}</h5>
                </div>
                <div class="card-block h-360">
                    <canvas id="devicesChart" class="d-none w-100 h-300px"></canvas>
                    <div class="placeholder wave h-300px">
                        <div class="square"></div>
                    </div>
                    <h6 class="text-secondary d-none">{{ __('No data available.') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card visitor">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="font-weight-600 c-gray-5">{{ __('Visitor') }}</h5>
                </div>
                <div class="card-block h-360">
                    <canvas id="visitorsChart" class="d-none h-360px w-100"></canvas>
                    <div class="placeholder wave h-300px">
                        <div class="square"></div>
                    </div>
                    <h6 class="text-secondary d-none">{{ __('No data available.') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card location">
                <div class="card-header">
                    <h5 class="font-weight-600 c-gray-5">{{ __('Location') }}</h5>
                </div>
                <div class="card-block h-360">
                    <canvas id="locationChart" class="d-none w-100 h-300px"></canvas>
                    <div class="placeholder wave h-300px">
                        <div class="square"></div>
                    </div>
                    <h6 class="text-secondary d-none">{{ __('No data available.') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            @include('googleanalytics::partials.active_users')
        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/chart-chartjs/js/Chart-2019.min.js') }}"></script>
    <script src="{{ asset('Modules/GoogleAnalytics/Resources/assets/js/google-analytics.min.js') }}"></script>
@endsection
