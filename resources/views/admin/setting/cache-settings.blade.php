@extends('admin.layouts.app')
@push('title')
{{ $title }}
@endpush
@section('content')
<div class="p-30">
    <!-- Page title -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Manage and clear different types of application cache.') }}</p>
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
                    <h5 class="card-title">{{ __(@$pageTitle ?: $title) }}</h5>

                    <div class="row g-3">
                        <div class="col-xxl-6 col-lg-6 col-md-12">
                            <div class="dashboard-settings-card h-100">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div>
                                        <h6 class="card-title mb-1">{{ __('Clear View Cache') }}</h6>
                                        <p class="text-muted mb-3">{{ __('Remove compiled blade views.') }}</p>
                                    </div>
                                    <div class="mt-auto w-100">
                                        <a href="{{ route('admin.setting.cache-update', 1) }}"
                                           class="primary_button w-100">
                                            {{ __('Click Here') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-6 col-md-12">
                            <div class="dashboard-settings-card h-100">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div>
                                        <h6 class="card-title mb-1">{{ __('Clear Route Cache') }}</h6>
                                        <p class="text-muted mb-3">{{ __('Refresh cached routes.') }}</p>
                                    </div>
                                    <div class="mt-auto w-100">
                                        <a href="{{ route('admin.setting.cache-update', 2) }}"
                                           class="primary_button w-100">
                                            {{ __('Click Here') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-6 col-md-12">
                            <div class="dashboard-settings-card h-100">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div>
                                        <h6 class="card-title mb-1">{{ __('Clear Config Cache') }}</h6>
                                        <p class="text-muted mb-3">{{ __('Reload configuration values.') }}</p>
                                    </div>
                                    <div class="mt-auto w-100">
                                        <a href="{{ route('admin.setting.cache-update', 3) }}"
                                           class="primary_button w-100">
                                            {{ __('Click Here') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-6 col-md-12">
                            <div class="dashboard-settings-card h-100">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div>
                                        <h6 class="card-title mb-1">{{ __('Application Clear Cache') }}</h6>
                                        <p class="text-muted mb-3">{{ __('Clear application cache store.') }}</p>
                                    </div>
                                    <div class="mt-auto w-100">
                                        <a href="{{ route('admin.setting.cache-update', 4) }}"
                                           class="primary_button w-100">
                                            {{ __('Click Here') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-6 col-md-12">
                            <div class="dashboard-settings-card h-100">
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <div>
                                        <h6 class="card-title mb-1">{{ __('Storage Link') }}</h6>
                                        <p class="text-muted mb-3">{{ __('Recreate storage symbolic link.') }}</p>
                                    </div>
                                    <div class="mt-auto w-100">
                                        <a href="{{ route('admin.setting.cache-update', 5) }}"
                                           class="primary_button w-100">
                                            {{ __('Click Here') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


