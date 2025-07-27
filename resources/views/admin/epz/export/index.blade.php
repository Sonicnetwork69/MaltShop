@extends('admin.layouts.app')

@section('page_title', __('Export'))

@section('content')
    <div class="col-sm-12 list-container" id="item-list-container">
        <div class="card">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <h5> {{ __('Export') }} </h5>
            </div>
            <div class="card-body p-0 import-table">
                <div class="card-block px-2">
                    <div class="col-sm-12 row p-0 m-0">
                        <a href="{{ route('epz.export.products') }}" class="col-md-6 col-xl-4">
                            <div class="card table-card">
                                <div class="row-table">
                                    <div class="col-auto bg-yellow text-black p-t-50 p-b-50">
                                        <i class="feather icon-user-plus f-30"></i>
                                    </div>
                                    <div class="col text-center">
                                        <h3 class="f-w-300">{{ __('Export Products') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
