@extends('admin.layouts.app')
@section('page_title', __('Google analytics settings'))
@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="analyticsSettings-add-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('analytics.dashboard') }}">{{ __('Google Analytics') }} </a>
                    >>{{ __(' :x', ['x' => __('Settings')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('analytics.settings.store') }}" method="post" id="analyticsSettingsAdd"
                        class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase font-bold" id="home-tab" data-bs-toggle="tab"
                                    href="#home" role="tab" aria-controls="home"
                                    aria-selected="true">{{ __(':x Settings', ['x' => __('Google Analytics')]) }}</a>
                            </li>
                        </ul>
                        <div class="tab-content form-edit-con" id="myTabContent">
                            <div class="tab-pane fade show active form-con" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label for="property_id" class="control-label require ps-3">{{ __('Property ID') }}
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" placeholder="{{ __('Property ID') }}"
                                                    class="form-control form-width inputFieldDesign" id="property_id"
                                                    name="propertyId" value="{{ $propertyId }}" required
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="measurement_id"
                                                class="control-label require ps-3">{{ __('Measurement ID') }}
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" placeholder="{{ __('Measurement ID') }}"
                                                    class="form-control form-width inputFieldDesign" id="measurement_id"
                                                    name="measurement_id" value="{{ $measurementId }}" required
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label require  ps-3">{{ __('Private Key File') }}</label>
                                            <div class="col-sm-12">
                                                <div class="custom-file" data-val="single" id="image-status">
                                                    <input type="file"
                                                        class="custom-file-input form-control d-none inputFieldDesign"
                                                        name="attachments" id="validatedCustomFile">
                                                    <label
                                                        class="custom-file-label overflow_hidden position-relative d-flex align-items-center"
                                                        for="validatedCustomFile">{{ __('Select file') }}</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-md-flex justify-content-start align-items-center mt-3 mt-md-0 ms-0 ms-md-5">
                                <a href="{{ route('analytics.dashboard') }}"
                                    class="custom-btn-cancel all-cancel-btn ms-0 ms-md-2 me-3">{{ __('Cancel') }}</a>
                                <button class="btn custom-btn-submit mb-0 mt-3 mt-md-0" type="submit" id="btnSubmit"><i
                                        class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span
                                        id="spinnerText">{{ __('Save') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
