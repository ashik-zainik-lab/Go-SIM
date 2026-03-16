<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

<body class="{{ selectedLanguage()->rtl == 1 ? 'direction-rtl' : 'direction-ltr' }}">
    <input type="hidden" id="lang_code" value="{{ session('local') }}">

    @if (getOption('app_preloader_status', 0) == STATUS_ACTIVE)
        <div id="preloader">
            <div id="preloader_status">
                <img src="{{ getSettingImage('app_preloader') }}" alt="{{ getOption('app_name') }}" />
            </div>
        </div>
    @endif

    <!-- Sidebar + Main Content (GoSIM dashboard layout) -->
    @include('layouts.sidebar')

    <section class="main_content dashboard_part">
        <!-- Top header / navbar -->
        @include('layouts.nav')

        <!-- Page content -->
        <div class="dashboard-content">
            @yield('content')
        </div>
    </section>

    @if (!empty(getOption('cookie_status')) && getOption('cookie_status') == STATUS_ACTIVE)
        <div class="cookie-consent-wrap shadow-lg">
            @include('cookie-consent::index')
        </div>
    @endif

    @include('layouts.script')
</body>

</html>
