@extends('admin.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <!-- Page title -->
        <div class="dashboard-section-title">
            <h2 class="title">{{ __($title) }}</h2>
            <p>{{ __('Configure your app logos, favicon and auth page image.') }}</p>
        </div>

        <div class="d-flex align-items-start settings-grid-container">
            <!-- Left sidebar -->
            <aside class="settings-sidebar">
                @include('admin.setting.partials.general-sidebar')
            </aside>

            <!-- Right content -->
            <div class="settings-forms w-100">
                <div class="dashboard-settings-card has-min-height">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Logo Settings') }}</h5>

                        <form class="ajax" action="{{route('admin.setting.application-settings.update')}}"
                              method="POST"
                              enctype="multipart/form-data" data-handler="commonResponseForModal">
                            @csrf

                            <div class="row g-3">
                                <!-- App Preloader -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="show-logo-wrap">
                                        <p class="title-text">{{ __('App Preloader') }}</p>
                                        <div class="show-logo">
                                            @if(getOption('app_preloader'))
                                                <img src="{{ getSettingImage('app_preloader') }}" alt="Logo"/>
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo">
                                            @endif
                                        </div>
                                        <p class="title-text">Recommended Size : 140 X 40</p>
                                        <div class="mt-2">
                                            <input type="file" name="app_preloader"
                                                   accept="image/*,video/*" onchange="previewFile(this)"/>
                                            @if ($errors->has('app_preloader'))
                                                <span class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('app_preloader') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Logo White -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="show-logo-wrap">
                                        <p class="title-text">{{ __('App Logo (White)') }}</p>
                                        <div class="show-logo">
                                            @if(getOption('app_logo'))
                                                <img src="{{ getSettingImage('app_logo') }}" alt="Logo"/>
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo">
                                            @endif
                                        </div>
                                        <p class="title-text">Recommended Size : 140 X 40</p>
                                        <div class="mt-2">
                                            <input type="file" name="app_logo"
                                                   accept="image/*,video/*" onchange="previewFile(this)"/>
                                            @if ($errors->has('app_logo'))
                                                <span class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('app_logo') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Logo Black -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="show-logo-wrap">
                                        <p class="title-text">{{ __('App Logo (Black)') }}</p>
                                        <div class="show-logo">
                                            @if(getOption('app_black_logo'))
                                                <img src="{{ getSettingImage('app_black_logo') }}" alt="Logo"/>
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo">
                                            @endif
                                        </div>
                                        <p class="title-text">Recommended Size : 140 X 40</p>
                                        <div class="mt-2">
                                            <input type="file" name="app_black_logo"
                                                   accept="image/*,video/*" onchange="previewFile(this)"/>
                                            @if ($errors->has('app_black_logo'))
                                                <span class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('app_black_logo') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Fav Icon -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="show-logo-wrap">
                                        <p class="title-text">{{ __('App Fav Icon') }}</p>
                                        <div class="show-logo">
                                            @if(getOption('app_fav_icon'))
                                                <img src="{{ getSettingImage('app_fav_icon') }}" alt="Logo"/>
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo"/>
                                            @endif
                                        </div>
                                        <p class="title-text">Recommended Size : 16 X 16</p>
                                        <div class="mt-2">
                                            <input type="file" name="app_fav_icon"
                                                   accept="image/*,video/*" onchange="previewFile(this)"/>
                                            @if ($errors->has('app_fav_icon'))
                                                <span class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('app_fav_icon') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Login Left Image -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="show-logo-wrap">
                                        <p class="title-text">{{ __('Login Left Image') }}</p>
                                        <div class="show-logo">
                                            @if(getOption('login_left_image'))
                                                <img src="{{ getSettingImage('login_left_image') }}" alt="Logo"/>
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo"/>
                                            @endif
                                        </div>
                                        <div class="mt-2">
                                            <input type="file" name="login_left_image"
                                                   accept="image/*,video/*" onchange="previewFile(this)"/>
                                            @if ($errors->has('login_left_image'))
                                                <span class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('login_left_image') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="input__group general-settings-btn text-end">
                                        <button type="submit"
                                                class="bd-ra-12 bg-cdef84 border-0 fw-500 hover-bg-one lh-25 px-26 py-10 mt-2">
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
