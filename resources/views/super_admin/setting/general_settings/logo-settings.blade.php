@extends('super_admin.layouts.app')
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
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <div class="dashboard-settings-card has-min-height">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Logo Settings') }}</h5>

                    <form class="ajax" action="{{route('super_admin.setting.application-settings.update')}}"
                        method="POST" enctype="multipart/form-data" data-handler="commonResponseForModal">
                        @csrf

                        <div class="row g-3">
                            <!-- App Preloader -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="show-logo-wrap">
                                    <p class="title-text">{{ __('App Preloader') }}</p>
                                    <div class="show-logo clickable-logo" data-input-id="logo_app_preloader">
                                        @if(getOption('app_preloader'))
                                        <img src="{{ getSettingImage('app_preloader') }}" alt="Logo" />
                                        @else
                                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo">
                                        @endif
                                    </div>
                                    <p class="title-text">Recommended Size : 140 X 40</p>
                                    <input id="logo_app_preloader" class="d-none logo-file-input" type="file"
                                        name="app_preloader" accept="image/*,video/*" />
                                    @if ($errors->has('app_preloader'))
                                    <span class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('app_preloader') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Logo White -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="show-logo-wrap">
                                    <p class="title-text">{{ __('App Logo (White)') }}</p>
                                    <div class="show-logo clickable-logo" data-input-id="logo_app_logo">
                                        @if(getOption('app_logo'))
                                        <img src="{{ getSettingImage('app_logo') }}" alt="Logo" />
                                        @else
                                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo">
                                        @endif
                                    </div>
                                    <p class="title-text">Recommended Size : 140 X 40</p>
                                    <input id="logo_app_logo" class="d-none logo-file-input" type="file" name="app_logo"
                                        accept="image/*,video/*" />
                                    @if ($errors->has('app_logo'))
                                    <span class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('app_logo') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Logo Black -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="show-logo-wrap">
                                    <p class="title-text">{{ __('App Logo (Black)') }}</p>
                                    <div class="show-logo clickable-logo" data-input-id="logo_app_black_logo">
                                        @if(getOption('app_black_logo'))
                                        <img src="{{ getSettingImage('app_black_logo') }}" alt="Logo" />
                                        @else
                                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo">
                                        @endif
                                    </div>
                                    <p class="title-text">Recommended Size : 140 X 40</p>
                                    <input id="logo_app_black_logo" class="d-none logo-file-input" type="file"
                                        name="app_black_logo" accept="image/*,video/*" />
                                    @if ($errors->has('app_black_logo'))
                                    <span class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('app_black_logo') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Fav Icon -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="show-logo-wrap">
                                    <p class="title-text">{{ __('App Fav Icon') }}</p>
                                    <div class="show-logo clickable-logo" data-input-id="logo_app_fav_icon">
                                        @if(getOption('app_fav_icon'))
                                        <img src="{{ getSettingImage('app_fav_icon') }}" alt="Logo" />
                                        @else
                                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo" />
                                        @endif
                                    </div>
                                    <p class="title-text">Recommended Size : 16 X 16</p>
                                    <input id="logo_app_fav_icon" class="d-none logo-file-input" type="file"
                                        name="app_fav_icon" accept="image/*,video/*" />
                                    @if ($errors->has('app_fav_icon'))
                                    <span class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('app_fav_icon') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Login Left Image -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="show-logo-wrap">
                                    <p class="title-text">{{ __('Login Left Image') }}</p>
                                    <div class="show-logo clickable-logo" data-input-id="logo_login_left_image">
                                        @if(getOption('login_left_image'))
                                        <img src="{{ getSettingImage('login_left_image') }}" alt="Logo" />
                                        @else
                                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Logo" />
                                        @endif
                                    </div>
                                    <p class="title-text">Recommended Size : 140 X 40</p>
                                    <input id="logo_login_left_image" class="d-none logo-file-input" type="file"
                                        name="login_left_image" accept="image/*,video/*" />
                                    @if ($errors->has('login_left_image'))
                                    <span class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('login_left_image') }}
                                    </span>
                                    @endif
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
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Clicking on logo box triggers hidden file input
    document.querySelectorAll('.clickable-logo').forEach(function(box) {
        box.addEventListener('click', function() {
            var inputId = this.getAttribute('data-input-id');
            var input = document.getElementById(inputId);
            if (input) {
                input.click();
            }
        });
    });

    // Preview selected image inside the same box
    document.querySelectorAll('.logo-file-input').forEach(function(input) {
        input.addEventListener('change', function(e) {
            var file = e.target.files[0];
            if (!file) return;

            var reader = new FileReader();
            reader.onload = function(ev) {
                var box = document.querySelector('.clickable-logo[data-input-id="' + input
                    .id + '"]');
                if (!box) return;
                var img = box.querySelector('img');
                if (!img) return;
                img.src = ev.target.result;
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endpush