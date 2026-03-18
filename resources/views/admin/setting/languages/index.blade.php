@extends('admin.layouts.app')
@push('title')
    {{$title}}
@endpush
@section('content')
<!-- Page content area start -->
<div class="p-30">
    <!-- Page title like setting.html -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Manage application languages, flags, and RTL support.') }}</p>
    </div>

    <!-- Settings layout like html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar -->
        <aside class="settings-sidebar">
            @include('admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <input type="hidden" id="language-route" value="{{ route('admin.setting.languages.index') }}">
            <div class="dashboard-settings-card has-min-height">
                <div class="card-body">
                    <div class="d-flex flex-wrap item-title justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">{{ __('Language Settings') }}</h5>
                        <button
                            class="primary_button d-flex align-items-center gap-2"
                            type="button" data-bs-toggle="modal" data-bs-target="#add-modal">
                            <i class="fa fa-plus me-1"></i> {{ __('Add Language') }}
                        </button>
                    </div>

                    <div class="dashboard_common_table table-responsive">
                        <table class="table zTable" id="commonDataTable">
                            <thead class="table-heading">
                                <tr>
                                    <th scope="col">
                                        <div>{{ __("Flag") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("Language") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("ISO code") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("RTL") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("Font") }}</div>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <div>{{ __("Action") }}</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content area end -->

<!-- Add Modal section start -->
<div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Language') }}</h5>
                <button type="button" class="border-0 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax reset" action="{{ route('admin.setting.languages.store') }}" method="post"
                data-handler="commonResponseForModal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row rg-25">
                        <div class="col-12">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="currentPassword" class="form-label">{{ __('Language') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="primary-form-control" name="language"
                                        placeholder="{{ __('Language') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="iso_code" class="form-label">{{ __('ISO Code') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="iso_code" class="primary-form-control" id="sf-select-modal-add">
                                        <option value="">--{{ __('Select ISO Code') }}--</option>
                                        @foreach(languageIsoCode() as $code => $isoCountryName)
                                        <option value="{{$code}}">{{ $isoCountryName.'('.$code.')' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap zImage-upload-details mw-100">
                                    <div class="zImage-inside">
                                        <div class="d-flex pb-12"><img
                                                src="{{ asset('assets/images/icon/upload-img-1.svg')}}" alt="" />
                                        </div>
                                        <p class="fs-15 fw-500 lh-16 text-1b1c17">{{__('Drag & drop files here')}}</p>
                                    </div>
                                    <label for="zImageUpload" class="form-label">{{__('Flag')}} <span
                                            class="text-mime-type">(jpeg,png,jpg,svg,webp)</span> <span
                                            class="text-danger">*</span></label>
                                    <div class="upload-img-box">
                                        <img src="" />
                                        <input type="file" name="flag" id="flag" accept="image/*"
                                            onchange="previewFile(this)" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="primary-form-group">
                            <div class="primary-form-group-wrap">
                                <label for="attachmentFile" class="form-label">{{ __('Font File') }}</label>
                                <input type="file" class="primary-form-control" id="attachmentFile"
                                    accept="application/pdf" name="font">
                                @if ($errors->has('font'))
                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                    $errors->first('font') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input__group">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label class="form-label" for="rtl">{{ __('RTL Supported') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="rtl" class="sf-select-without-search">
                                            <option value="0">{{__("No")}}</option>
                                            <option value="1">{{__("Yes")}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex form-check">
                                <div class="zCheck form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" name="default"
                                        role="switch" id="flexCheckChecked" />
                                </div>
                                <label class="form-check-label ps-3" for="flexCheckChecked">
                                    {{ __('Default Language') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="primary_button">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal section end -->

<!-- Edit Modal section start -->
<div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- Edit Modal section end -->
@endsection
@push('script')
<script src="{{asset('admin/js/languages.js')}}"></script>
@endpush
