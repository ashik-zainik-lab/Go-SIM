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
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $activeDashboard ?? '' }}">
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

            {{-- ESIM management --}}
            <li class="">
                <span class="category_title">{{ __('Esim management') }}</span>
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- Destinations icon from new design --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M3.27914 2.95951C3.64076 2.48768 3.82158 2.25176 4.06876 2.12588C4.31594 2 4.59838 2 5.16326 2H6.77372C7.35179 2 7.64079 2 7.82039 2.19526C7.99999 2.39053 7.99999 2.70479 7.99999 3.33333V6H5.16326C4.59838 6 4.31594 6 4.06876 5.87412C3.82158 5.74824 3.64076 5.51232 3.27914 5.04049L3.13588 4.85358C2.82306 4.44544 2.66666 4.24137 2.66666 4C2.66666 3.75863 2.82306 3.55456 3.13588 3.14642L3.27914 2.95951Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12.7209 6.29284C12.3592 5.82101 12.1784 5.58509 11.9312 5.45921C11.6841 5.33333 11.4016 5.33333 10.8367 5.33333H8V9.33333H10.8367C11.4016 9.33333 11.6841 9.33333 11.9312 9.20747C12.1784 9.0816 12.3592 8.84567 12.7209 8.3738L12.8641 8.18693C13.1769 7.7788 13.3333 7.57467 13.3333 7.33333C13.3333 7.092 13.1769 6.88787 12.8641 6.47975L12.7209 6.29284Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 14V2.66667" stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 14H10" stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Destinations') }}
                    </div>
                </a>
            </li>

            <li class="">
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- Plans icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M2.66663 6V13.3333" stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M5.33337 2.66667V13.3333" stroke="#505C77" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 7.33333V13.3333" stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10.6666 4.66667V13.3333" stroke="#505C77" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.3334 9.33333V13.3333" stroke="#505C77" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Plans') }}
                    </div>
                </a>
            </li>

            <li class="">
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- eSIMs icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M2 7.9056C2 4.85466 2 3.32917 2.92449 2.36263C2.95865 2.32692 2.99359 2.29198 3.02929 2.25783C3.99584 1.33333 5.52133 1.33333 8.57227 1.33333C9.29533 1.33333 9.64367 1.33584 9.9752 1.45957C10.2945 1.57873 10.5619 1.80159 11.0968 2.24733L12.5607 3.46728C13.2685 4.05707 13.6223 4.35197 13.8112 4.75511C14 5.15825 14 5.61889 14 6.54017V8.66667C14 11.1665 14 12.4164 13.3634 13.2926C13.1578 13.5756 12.9089 13.8245 12.6259 14.0301C11.7497 14.6667 10.4998 14.6667 8 14.6667C5.50018 14.6667 4.25027 14.6667 3.37405 14.0301C3.09107 13.8245 2.84221 13.5756 2.63661 13.2926C2 12.4164 2 11.1665 2 8.66667V7.9056Z"
                                stroke="#505C77" stroke-width="1.5" />
                            <path
                                d="M4.66663 9.66667C4.66663 10.7666 4.66663 11.3166 4.95952 11.6583C5.25241 12 5.72382 12 6.66663 12H9.33329C10.2761 12 10.7475 12 11.0404 11.6583C11.3333 11.3166 11.3333 10.7666 11.3333 9.66667M4.66663 9.66667C4.66663 8.56673 4.66663 8.01673 4.95952 7.67507C5.25241 7.33333 5.72382 7.33333 6.66663 7.33333H9.33329C10.2761 7.33333 10.7475 7.33333 11.0404 7.67507C11.3333 8.01673 11.3333 8.56673 11.3333 9.66667M4.66663 9.66667H5.99996M11.3333 9.66667H9.99996"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('eSIMs') }}
                    </div>
                </a>
            </li>

            {{-- Order Management --}}
            <li class="">
                <span class="category_title">{{ __('Order Management') }}</span>
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- Orders icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M8.66671 7.33334C8.66671 5.86058 7.47277 4.66667 6.00004 4.66667C4.52728 4.66667 3.33337 5.86058 3.33337 7.33334C3.33337 8.80607 4.52728 10 6.00004 10C7.47277 10 8.66671 8.80607 8.66671 7.33334Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M7.35911 5.03849C7.34211 4.91698 7.33337 4.79285 7.33337 4.66667C7.33337 3.19391 8.52731 2 10 2C11.4728 2 12.6667 3.19391 12.6667 4.66667C12.6667 6.13943 11.4728 7.33333 10 7.33333C9.50364 7.33333 9.03897 7.19773 8.64097 6.96153"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 14C10 11.7909 8.20913 10 6 10C3.79086 10 2 11.7909 2 14" stroke="#505C77"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 11.3333C14 9.12419 12.2091 7.33333 10 7.33333" stroke="#505C77"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Orders') }}
                    </div>
                </a>
            </li>

            {{-- User Management --}}
            <li class="">
                <span class="category_title">{{ __('User Management') }}</span>
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- Manage Users icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                             fill="none">
                            <path
                                d="M8.66671 7.33334C8.66671 5.86058 7.47277 4.66667 6.00004 4.66667C4.52728 4.66667 3.33337 5.86058 3.33337 7.33334C3.33337 8.80607 4.52728 10 6.00004 10C7.47277 10 8.66671 8.80607 8.66671 7.33334Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M7.35911 5.03849C7.34211 4.91698 7.33337 4.79285 7.33337 4.66667C7.33337 3.19391 8.52731 2 10 2C11.4728 2 12.6667 3.19391 12.6667 4.66667C12.6667 6.13943 11.4728 7.33333 10 7.33333C9.50364 7.33333 9.03897 7.19773 8.64097 6.96153"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 14C10 11.7909 8.20913 10 6 10C3.79086 10 2 11.7909 2 14" stroke="#505C77"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 11.3333C14 9.12419 12.2091 7.33333 10 7.33333" stroke="#505C77"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Manage Users') }}
                    </div>
                </a>
            </li>

            {{-- Deposits --}}
            <li class="">
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- Deposits icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                             fill="none">
                            <path
                                d="M4 13.0821C3.54062 12.9519 3.17848 12.7545 2.87868 12.4547C2 11.576 2 10.1617 2 7.33333C2 4.5049 2 3.09069 2.87868 2.21201C3.75736 1.33333 5.17157 1.33333 8 1.33333C10.8284 1.33333 12.2427 1.33333 13.1213 2.21201C14 3.09069 14 4.5049 14 7.33333C14 10.1617 14 11.576 13.1213 12.4547C12.8215 12.7545 12.4594 12.9519 12 13.0821"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round" />
                            <path
                                d="M8 13.4619C7.72387 13.4619 7.50167 13.6747 7.0572 14.1005C6.62627 14.5133 6.41082 14.7197 6.22916 14.6549C6.20685 14.647 6.18537 14.6365 6.16509 14.6237C6 14.5191 6 14.2074 6 13.5841V11.5008C6 10.4791 6 9.96819 6.29289 9.65073C6.58579 9.33333 7.0572 9.33333 8 9.33333C8.9428 9.33333 9.4142 9.33333 9.70713 9.65073C10 9.96819 10 10.4791 10 11.5008V13.5841C10 14.2074 10 14.5191 9.83493 14.6237C9.8146 14.6365 9.79313 14.647 9.77087 14.6549C9.5892 14.7197 9.37373 14.5133 8.9428 14.1005C8.49833 13.6747 8.27613 13.4619 8 13.4619Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M5.33337 6.66667H10.6667" stroke="#505C77" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.33337 4H8.00004" stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Deposits') }}
                    </div>
                </a>
            </li>

            {{-- Financial --}}
            <li class="">
                <span class="category_title">{{ __('Financial') }}</span>
                <a class="has_arrow" href="#">
                    <div class="nav_icon_small">
                        {{-- Financial Management icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                             fill="none">
                            <path
                                d="M9.66671 8.00066C9.66671 8.92113 8.92051 9.66733 8.00004 9.66733C7.07957 9.66733 6.33337 8.92113 6.33337 8.00066C6.33337 7.0802 7.07957 6.33398 8.00004 6.33398C8.92051 6.33398 9.66671 7.0802 9.66671 8.00066Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12.3334 7.66V7.66667" stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M3.66663 8.32666V8.33333" stroke="#505C77" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M10.6667 3.33398C12.3196 3.33398 13.4602 3.59012 14.0886 3.78486C14.4504 3.89699 14.6667 4.23991 14.6667 4.61868V11.1222C14.6667 11.8656 13.848 12.4249 13.1175 12.287C12.4908 12.1687 11.6738 12.0736 10.6667 12.0736C7.49944 12.0736 6.73977 13.2774 2.09657 12.2535C1.64847 12.1547 1.33337 11.7517 1.33337 11.2928V4.61476C1.33337 3.96418 1.94723 3.48976 2.58536 3.61638C6.79784 4.45229 7.61397 3.33398 10.6667 3.33398Z"
                                stroke="#505C77" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="nav_title">
                        {{ __('Financial Management') }}
                    </div>
                </a>
            </li>

            {{-- Settings / System configuration block keeps existing logic --}}
            @can('Manage Application Setting')
            <li class="">
                <span class="category_title settings_title">{{ __('Settings') }}</span>
                <a class="has_arrow {{ isset($showManageApplicationSetting) ? 'active' : '' }}"
                   href="#manage-application-menu" data-bs-toggle="collapse"
                   aria-expanded="{{ isset($showManageApplicationSetting) ? 'true' : 'false' }}"
                   aria-controls="manage-application-menu">
            <span class="category_title">{{ __('Application Settings') }}</span>
            <a class="has_arrow {{ isset($showManageApplicationSetting) ? 'active' : '' }}"
                href="#manage-application-menu" data-bs-toggle="collapse"
                aria-expanded="{{ isset($showManageApplicationSetting) ? 'true' : 'false' }}"
                aria-controls="manage-application-menu">
                <div class="nav_icon_small">
                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 6L10 1L1.5 6V16L10 21L18.5 16V6Z" stroke="#505C77" stroke-width="1.5"
                            stroke-linejoin="round" />
                        <path d="M6 8.49902L9.9965 11L13.9975 8.49902M10 11V15.5" stroke="#505C77" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="nav_title">
                    {{ __('Settings') }}
                </div>
            </a>
            <div class="collapse {{ $showManageApplicationSetting ?? '' }}" id="manage-application-menu"
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
                        <a class="{{ $activeGatewaySetting ?? '' }}" href="{{ route('admin.setting.gateway.index') }}">
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