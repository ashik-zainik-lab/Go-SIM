<!-- Sidebar using new GoSIM design, logic unchanged -->
<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="{{ route('index') }}">
            <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}">
        </a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>

    <ul id="sidebar_menu">
        @if (auth()->user()->role == USER_ROLE_ADMIN)
            {{-- Dashboard --}}
            <li class="">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ $activeDashboard ?? '' }}">
                    <div class="nav_icon_small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M7 5.83333V4.5C7 3.40417 7 2.85626 6.69733 2.48747C6.64194 2.41997 6.58003 2.35806 6.51253 2.30265C6.14374 2 5.59583 2 4.5 2C3.40417 2 2.85626 2 2.48747 2.30265C2.41997 2.35806 2.35806 2.41997 2.30265 2.48747C2 2.85626 2 3.40417 2 4.5V5.83333C2 6.92913 2 7.47707 2.30265 7.84587C2.35806 7.9134 2.41997 7.97527 2.48747 8.03067C2.85626 8.33333 3.40417 8.33333 4.5 8.33333C5.59583 8.33333 6.14374 8.33333 6.51253 8.03067C6.58003 7.97527 6.64194 7.9134 6.69733 7.84587C7 7.47707 7 6.92913 7 5.83333Z"
                                stroke="#505C77" stroke-width="1.3" stroke-linejoin="round" />
                            <path
                                d="M5.16667 10.3333H3.83333C3.36815 10.3333 3.13555 10.3333 2.94629 10.3907C2.52015 10.52 2.18668 10.8535 2.05741 11.2796C2 11.4689 2 11.7015 2 12.1667C2 12.6319 2 12.8645 2.05741 13.0537C2.18668 13.4799 2.52015 13.8133 2.94629 13.9426C3.13555 14 3.36815 14 3.83333 14H5.16667C5.63185 14 5.86445 14 6.05371 13.9426C6.47985 13.8133 6.81333 13.4799 6.9426 13.0537C7 12.8645 7 12.6319 7 12.1667C7 11.7015 7 11.4689 6.9426 11.2796C6.81333 10.8535 6.47985 10.52 6.05371 10.3907C5.86445 10.3333 5.63185 10.3333 5.16667 10.3333Z"
                                stroke="#505C77" stroke-width="1.3" stroke-linejoin="round" />
                            <path
                                d="M14 11.5V10.1667C14 9.07086 14 8.52293 13.6973 8.15413C13.6419 8.0866 13.5801 8.02473 13.5125 7.96933C13.1437 7.66666 12.5958 7.66666 11.5 7.66666C10.4042 7.66666 9.85627 7.66666 9.48747 7.96933C9.41993 8.02473 9.35807 8.0866 9.30267 8.15413C9 8.52293 9 9.07086 9 10.1667V11.5C9 12.5958 9 13.1437 9.30267 13.5125C9.35807 13.5801 9.41993 13.6419 9.48747 13.6973C9.85627 14 10.4042 14 11.5 14C12.5958 14 13.1437 14 13.5125 13.6973C13.5801 13.6419 13.6419 13.5801 13.6973 13.5125C14 13.1437 14 12.5958 14 11.5Z"
                                stroke="#505C77" stroke-width="1.3" stroke-linejoin="round" />
                            <path
                                d="M12.1667 2H10.8333C10.3681 2 10.1355 2 9.94627 2.05741C9.52013 2.18668 9.18667 2.52015 9.0574 2.94629C9 3.13555 9 3.36815 9 3.83333C9 4.29852 9 4.53111 9.0574 4.72038C9.18667 5.14651 9.52013 5.47999 9.94627 5.60925C10.1355 5.66667 10.3681 5.66667 10.8333 5.66667H12.1667C12.6319 5.66667 12.8645 5.66667 13.0537 5.60925C13.4799 5.47999 13.8133 5.14651 13.9426 4.72038C14 4.53111 14 4.29852 14 3.83333C14 3.36815 14 3.13555 13.9426 2.94629C13.8133 2.52015 13.4799 2.18668 13.0537 2.05741C12.8645 2 12.6319 2 12.1667 2Z"
                                stroke="#505C77" stroke-width="1.3" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Dashboard') }}
                    </div>
                </a>
            </li>
        @endif

        @if (auth()->user()->role == USER_ROLE_ADMIN)
            @can('Manage Application Setting')
                <li class="">
                    <span class="category_title">{{ __('Application Settings') }}</span>
                    <a class="has_arrow {{ isset($showManageApplicationSetting) ? 'active' : '' }}"
                       href="#manage-application-menu"
                       data-bs-toggle="collapse"
                       aria-expanded="{{ isset($showManageApplicationSetting) ? 'true' : 'false' }}"
                       aria-controls="manage-application-menu">
                        <div class="nav_icon_small">
                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.5 6L10 1L1.5 6V16L10 21L18.5 16V6Z" stroke="#505C77"
                                      stroke-width="1.5" stroke-linejoin="round"/>
                                <path d="M6 8.49902L9.9965 11L13.9975 8.49902M10 11V15.5" stroke="#505C77"
                                      stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="nav_title">
                            {{ __('Settings') }}
                        </div>
                    </a>
                    <div class="collapse {{ $showManageApplicationSetting ?? '' }}"
                         id="manage-application-menu"
                         data-bs-parent="#sidebar_menu">
                        <ul class="submenu">
                            <li>
                                <a class="{{ $activeApplicationSetting ?? '' }}"
                                   href="{{ route('admin.setting.application-settings') }}">
                                    {{ __('General Settings') }}
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeConfigurationSetting ?? '' }}"
                                   href="{{ route('admin.setting.configuration-settings') }}">
                                    {{ __('Configurations Settings') }}
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeCurrenciesSetting ?? '' }}"
                                   href="{{ route('admin.setting.currencies.index') }}">
                                    {{ __('Currency Settings') }}
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeGatewaySetting ?? '' }}"
                                   href="{{ route('admin.setting.gateway.index') }}">
                                    {{ __('Payment Gateways') }}
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeLanguagesSetting ?? '' }}"
                                   href="{{ route('admin.setting.languages.index') }}">
                                    {{ __('Language Settings') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
        @endif
    </ul>

    <ul class="sidebar_bottom">
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="d-flex align-items-center">
                <img src="{{ asset('assets/images/icon/logout.svg') }}" alt="{{ __('Logout') }}">
                <span>{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
