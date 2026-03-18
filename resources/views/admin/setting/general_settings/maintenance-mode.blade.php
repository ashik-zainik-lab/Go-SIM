@extends('admin.layouts.app')
@push('title')
{{ $title }}
@endpush
@section('content')
<div class="p-30">
    <!-- Page title -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Control maintenance mode behavior and access.') }}</p>
    </div>

    <!-- Settings layout like html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar -->
        <aside class="settings-sidebar">
            @include('admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <div class="dashboard-settings-card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Maintenance Mode Settings') }}</h5>

                    <!-- Instructions -->
                    <div class="bg-scroll-thumb p-4 border-1 mb-3">
                        <h5>{{ __('Instructions') }}: </h5>
                        <p>{{ __("You need to follow some instruction after maintenance mode changes. Instruction list given below-") }}
                        </p>
                        <div class="text-black">
                            <li>{{ __("If you select maintenance mode") }} <b>{{ __("Maintenance O") }}n</b>,
                                {{__("you need to input secret key for maintenance work. Otherwise you can't work this website. And your created secret key helps you to work under
                                    maintenance.")}}
                            </li>
                            <li>{{ __("After created maintenance key, you can use this website secretly through this ur") }}
                                l <span class="iconify" data-icon="arcticons:url-forwarder"></span> <span
                                    class="text-primary">{{ url('/') }}/(Your created secret key)</span></li>
                            <li>{{__("Only one time url is browsing with secret key, and you can browse your site in maintenance mode. When maintenance mode on, any user can see
                                    maintenance mode error message.")}}
                            </li>
                            <li>{{ __("Unfortunately you forget your secret key and try to connect with your website.") }}
                                <br> {{ __("Then you go to your project folder location") }}
                                <b>{{ __("Main Files") }}</b>{{ __("(where your file in cpanel or your hosting)") }}
                                <span class="iconify"
                                    data-icon="arcticons:url-forwarder"></span><b>{{ __("storage") }}</b>
                                <span class="iconify"
                                    data-icon="arcticons:url-forwarder"></span><b>{{ __("framework") }}</b>.
                                {{ __("You can see 2 files and need to delete 2 files. Files are:") }}
                                <br>
                                {{ __("1. down") }} <br>
                                {{ __("2. maintenance.php") }}
                            </li>
                        </div>
                    </div>

                    <!-- Form -->
                    <form class="ajax" action="{{route('admin.setting.maintenance.change')}}" method="POST"
                        enctype="multipart/form-data" data-handler="commonResponseForModal">
                        @csrf

                        <div class="row g-3">
                            <div class="col-xxl-4 col-lg-4 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Maintenance Mode') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="maintenance_mode"
                                        class="form-control maintenance_mode sf-select-without-search">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="1" @if(getOption('maintenance_mode')==1) selected @endif>
                                            {{ __('Maintenance On') }}</option>
                                        <option value="2" @if(getOption('maintenance_mode') !=1) selected @endif>
                                            {{ __('Live') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-4 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Maintenance Mode Secret Key') }}</label>
                                    <input type="text" name="maintenance_secret_key"
                                        value="{{ getOption('maintenance_secret_key') }}" minlength="6"
                                        class="primary-form-control maintenance_secret_key"
                                        placeholder="{{ __('Minimum 6 characters') }}">
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-4 col-md-12">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Maintenance Mode Url') }}</label>
                                    <input type="text" name="" value=""
                                        class="primary-form-control maintenance_mode_url" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end text-end mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="primary_button float-right">
                                    {{ __('Update') }}
                                </button>
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
<script>
'use strict'
let getUrl = "{{ url('') }}";
const maintenanceSecretKey = "{{ getOption('maintenance_secret_key') }}";
const maintenanceModeConst = "{{ getOption('maintenance_mode') }}";
</script>
<script src="{{ asset('admin/js/maintenance-mode.js') }}"></script>
@endpush