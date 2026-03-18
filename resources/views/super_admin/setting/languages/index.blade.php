@extends('super_admin.layouts.app')
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
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <input type="hidden" id="language-route" value="{{ route('super_admin.setting.languages.index') }}">
            <div class="dashboard-settings-card has-min-height">
                <div class="card-body">
                    <div class="d-flex flex-wrap item-title justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">{{ __('Language Settings') }}</h5>
                        <button class="primary_button d-flex align-items-center gap-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#add-modal">
                            <i class="fa fa-plus me-1"></i> {{ __('Add Language') }}
                        </button>
                    </div>

                    <!-- Search and Add Button -->
                    <div class="dashboard_search_addNew_box mb-3">
                        <div class="serach_field_area">
                            <form action="#">
                                <div class="search_field">
                                    <img class="search-image" src="{{ asset('assets/images/icons/search.svg') }}"
                                        alt="search icon">
                                    <input type="text" placeholder="{{ __('Search Languages...') }}" name="search"
                                        id="languageSearchInput">
                                </div>
                            </form>
                        </div>
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
<div class="modal fade dashboard-common-modal" id="add-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h2>{{ __('Add Language') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form class="modal-form ajax reset" action="{{ route('super_admin.setting.languages.store') }}" method="post"
                    data-handler="commonResponseForModal" enctype="multipart/form-data">
                    @csrf

                    <!-- Row 1 -->
                    <div class="form-row">
                        <div class="dashboard-form-group full-width mb-2">
                            <label class="form-label">{{ __('Language') }} <span class="text-danger">*</span></label>
                            <input type="text" class="primary-form-control" name="language"
                                placeholder="{{ __('Type language name') }}" required>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-row">
                        <div class="dashboard-form-group full-width mb-2">
                            <label class="form-label">{{ __('ISO Code') }} <span class="text-danger">*</span></label>
                            <select name="iso_code" class="primary-form-control" id="sf-select-modal-add" required>
                                <option value="">--{{ __('Select ISO Code') }}--</option>
                                @foreach(languageIsoCode() as $code => $isoCountryName)
                                <option value="{{$code}}">{{ $isoCountryName.'('.$code.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-row">
                        <div class="dashboard-form-group full-width">
                            <label class="form-label d-block">{{ __('Flag') }} <span
                                    class="text-mime-type">(jpeg,png,jpg,svg,webp)</span> <span
                                    class="text-danger">*</span></label>
                            <div class="zImage-upload-details mw-100">
                                <div class="zImage-inside">
                                    <div class="d-flex pb-12">
                                        <img src="{{ asset('assets/images/icon/upload-img-1.svg')}}" alt="upload" />
                                    </div>
                                    <p class="fs-15 fw-500 lh-16 text-1b1c17">{{__('Drag & drop files here')}}</p>
                                </div>
                                <div class="upload-img-box">
                                    <img src="" />
                                    <input type="file" name="flag" id="flag" accept="image/*"
                                        onchange="previewFile(this)" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-row">
                        <div class="dashboard-form-group full-width mb-2">
                            <label class="form-label" for="rtl">{{ __('RTL Supported') }} <span
                                    class="text-danger">*</span></label>
                            <select name="rtl" class="primary-form-control" required>
                                <option value="0">{{__("No")}}</option>
                                <option value="1">{{__("Yes")}}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="form-row">
                        <div class="dashboard-form-group full-width">
                            <label class="form-label d-block">{{ __('Default Language') }}</label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="default" value="1">
                                <span class="custom-box"></span>
                                <span class="text">{{ __('Set as default language') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <button type="button" class="primary_button cancel" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="primary_button">
                            {{ __('Save Language') }}
                        </button>
                    </div>

                </form>
            </div>

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
<script src="{{asset('super_admin/js/languages.js')}}"></script>
@endpush