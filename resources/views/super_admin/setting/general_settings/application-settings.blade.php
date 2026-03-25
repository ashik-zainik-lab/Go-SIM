@extends('super_admin.layouts.app')
@push('title')
{{ $title }}
@endpush
@section('content')
<div class="p-30">
    <!-- Page title like setting.html -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Manage core application information and contact details.') }}</p>
    </div>

    <!-- Settings layout like html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar tabs (uses updated general-sidebar) -->
        <aside class="settings-sidebar">
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <div class="dashboard-settings-card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Application Settings') }}</h5>

                    <form class="ajax" action="{{ route('super_admin.setting.application-settings.update') }}"
                        method="POST" enctype="multipart/form-data" data-handler="settingCommonHandler">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('App Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="app_name" value="{{ getOption('app_name') }}"
                                        class="primary-form-control">
                                </div>
                            </div>


                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('App URL') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="APP_URL" value="{{ getOption('APP_URL') }}"
                                        class="primary-form-control">
                                </div>
                            </div>


                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('App Email') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="app_email" value="{{ getOption('app_email') }}"
                                        class="primary-form-control">
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('App Contact Number') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="app_contact_number"
                                        value="{{ getOption('app_contact_number') }}" class="primary-form-control">
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('App Location') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="app_location" value="{{ getOption('app_location') }}"
                                        class="primary-form-control">
                                </div>
                            </div>


                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('App Copyright') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="app_copyright" value="{{ getOption('app_copyright') }}"
                                        class="primary-form-control">
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Developed By') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="app_developed" value="{{ getOption('app_developed') }}"
                                        class="primary-form-control">
                                </div>
                            </div>


                            <div class="col-xxl-4 col-lg-6 col-md-6">
                                <div class="dashboard-form-group">
                                    <label for="app_timezone" class="form-label">{{ __('Timezone') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="app_timezone" class="form-control sf-select">
                                        @foreach ($timezones as $timezone)
                                        <option value="{{ $timezone }}"
                                            {{ $timezone == getOption('app_timezone') ? 'selected' : '' }}>
                                            {{ $timezone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="input__group general-settings-btn text-end">
                                    <button type="submit" class="primary_button">
                                        {{ __('Update') }}
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