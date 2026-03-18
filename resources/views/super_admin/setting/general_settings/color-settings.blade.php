@extends('super_admin.layouts.app')
@push('title')
{{ $title }}
@endpush
@push('style')
<link rel="stylesheet" href="{{ asset('super_admin/css/codemirror.css') }}" />
<link rel="stylesheet" href="{{ asset('super_admin/css/monokai.css') }}" />
@endpush
@section('content')
<div class="p-30">
    <!-- Page title -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Customize system colors, CSS and JS to match your brand.') }}</p>
    </div>

    <!-- Settings layout matching html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar -->
        <aside class="settings-sidebar">
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <!-- System Color Settings -->
            <div class="dashboard-settings-card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Color Settings') }}</h5>

                    <form class="ajax" action="{{route('super_admin.setting.application-settings.update')}}"
                        method="POST" enctype="multipart/form-data" data-handler="commonResponseForModal">
                        @csrf

                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="dashboard-form-group">
                                    <label for="app_color_design_type"
                                        class="form-label">{{ __('System Color') }}</label>
                                    <select name="app_color_design_type" id="app_color_design_type"
                                        class="form-control sf-select-without-search" required>
                                        <option value="{{ DEFAULT_COLOR }}"
                                            {{ getOption('app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR ? 'selected' : '' }}>
                                            {{ __('Default') }}</option>
                                        <option value="{{ CUSTOM_COLOR }}"
                                            {{ getOption('app_color_design_type', DEFAULT_COLOR) == CUSTOM_COLOR ? 'selected' : '' }}>
                                            {{ __('Custom') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 {{getOption('app_color_design_type', DEFAULT_COLOR) == DEFAULT_COLOR ? 'd-none' : ''}}"
                            id="custom-color-block">
                            <div class="col-xxl-2 col-lg-6">
                                <div class="sf-new-color-wrap">
                                    <div class="dashboard-form-group">
                                        <label class="form-label">{{ __('Primary Color') }} <span
                                                class="text-danger">*</span></label>
                                        <label for="app_primary_color" class="mb-0">
                                            <input class="color5 primary-form-control" type="color"
                                                name="app_primary_color"
                                                value="{{getOption('app_primary_color', '#cdef84')}}"
                                                id="app_primary_color">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <div class="sf-new-color-wrap">
                                    <div class="dashboard-form-group">
                                        <label class="form-label">{{ __('Hover Color') }} <span
                                                class="text-danger">*</span></label>
                                        <label for="app_hover_color" class="mb-0">
                                            <input class="color5 primary-form-control" type="color"
                                                name="app_hover_color"
                                                value="{{getOption('app_hover_color', '#afd449')}}"
                                                id="app_hover_color">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <div class="sf-new-color-wrap">
                                    <div class="dashboard-form-group">
                                        <label class="form-label">{{ __('Text Color') }} <span
                                                class="text-danger">*</span></label>
                                        <label for="app_text_color" class="mb-0">
                                            <input class="color5 primary-form-control" type="color"
                                                name="app_text_color" value="{{getOption('app_text_color', '#1b1c17')}}"
                                                id="app_text_color">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <div class="sf-new-color-wrap">
                                    <div class="dashboard-form-group">
                                        <label class="form-label">{{ __('Text Secondary Color') }} <span
                                                class="text-danger">*</span></label>
                                        <label for="app_text_secondary_color" class="mb-0">
                                            <input class="color5 primary-form-control" type="color"
                                                name="app_text_secondary_color"
                                                value="{{getOption('app_text_secondary_color', '#707070')}}"
                                                id="app_text_secondary_color">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <div class="sf-new-color-wrap">
                                    <div class="dashboard-form-group">
                                        <label class="form-label">{{ __('Sidebar BG Color') }} <span
                                                class="text-danger">*</span></label>
                                        <label for="app_sidebar_bg_color" class="mb-0">
                                            <input class="color5 primary-form-control" type="color"
                                                name="app_sidebar_bg_color"
                                                value="{{getOption('app_sidebar_bg_color', '#1b1c17')}}"
                                                id="app_sidebar_bg_color">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <div class="sf-new-color-wrap">
                                    <div class="dashboard-form-group">
                                        <label class="form-label">{{ __('Sidebar Text Color') }} <span
                                                class="text-danger">*</span></label>
                                        <label for="app_sidebar_text_color" class="mb-0">
                                            <input class="color5 primary-form-control" type="color"
                                                name="app_sidebar_text_color"
                                                value="{{getOption('app_sidebar_text_color', '#f6f5f5')}}"
                                                id="app_sidebar_text_color">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="input__group general-settings-btn text-end">
                                    <button type="submit" class="primary_button">
                                        {{__('Update')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Custom CSS -->
            <div class="dashboard-settings-card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Custom CSS') }}</h5>
                    <form class="ajax" action="{{route('super_admin.setting.application-settings.update')}}"
                        method="POST" enctype="multipart/form-data" data-handler="commonResponseForModal">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-outline card-info mb-0">
                                    <div class="card-header">
                                        {{ __('Custom CSS') }}
                                    </div>
                                    <div class="card-body">
                                        <textarea name="custom_css"
                                            id="custom-css-editor">{{getOption('custom_css', '/*css code here*/ ')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="input__group general-settings-btn text-end">
                                    <button type="submit" class="primary_button">
                                        {{__('Update')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Custom JS -->
            <div class="dashboard-settings-card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Custom JS') }}</h5>
                    <form class="ajax" action="{{route('super_admin.setting.application-settings.update')}}"
                        method="POST" enctype="multipart/form-data" data-handler="commonResponseForModal">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-outline card-info mb-0">
                                    <div class="card-header">
                                        {{ __('Custom JS') }}
                                    </div>
                                    <div class="card-body">
                                        <textarea name="custom_js"
                                            id="custom-js-editor">{{getOption('custom_js', '//js code here')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="input__group general-settings-btn text-end">
                                    <button type="submit" class="primary_button">
                                        {{__('Update')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('super_admin/js/codemirror.js') }}"></script>
<script src="{{ asset('super_admin/js/codemirror-mode.js') }}"></script>
<script src="{{ asset('super_admin/js/codemirror-js-mode.js') }}"></script>
<script>
$(function() {
    //Get Value
    document.querySelectorAll('input[type=color]').forEach(function(picker) {
        //Target Point
        var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
            codeArea = document.createElement('span');

        codeArea.innerHTML = picker.value;
        targetLabel.appendChild(codeArea);

        //Now AddEventListener
        picker.addEventListener('change', function() {
            codeArea.innerHTML = picker.value;
            targetLabel.appendChild(codeArea);
        });
    });
})

$(document).on('change', '#app_color_design_type', function() {
    if ($(this).val() == {
            {
                DEFAULT_COLOR
            }
        }) {
        $('#custom-color-block').addClass('d-none');
    } else {
        $('#custom-color-block').removeClass('d-none');
    }
});

CodeMirror.fromTextArea(document.getElementById("custom-css-editor"), {
    mode: "css",
    theme: "monokai"
})

CodeMirror.fromTextArea(document.getElementById("custom-js-editor"), {
    mode: "javascript",
    theme: "monokai",
});
</script>
@endpush