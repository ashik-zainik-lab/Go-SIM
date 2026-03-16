<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="header_right_content d-flex align-items-center">
                    <!-- Mobile sidebar toggle -->
                    <div class="menu-icon" id="mobileMenuIcon">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>

                    <!-- Breadcrumb -->
                    <ul class="custom-breadcrumb">
                        <li>
                            <a href="{{ route('index') }}">{{ getOption('app_name') }} /</a>
                        </li>
                        <li>
                            <span>@stack('title', __('Dashboard'))</span>
                        </li>
                    </ul>
                </div>

                <div class="header_right d-flex align-items-center">
                    <!-- Search (optional, can be wired later) -->
                    <div class="serach_field_area">
                        <form action="#">
                            <div class="search_field">
                                <img class="search-image" src="{{ asset('assets/images/icon/search-1.svg') }}"
                                     alt="search icon">
                                <input type="text" placeholder="{{ __('Search...') }}" name="search">
                            </div>
                        </form>
                    </div>

                    <!-- Notifications -->
                    <div class="dropdown notification_dropdown_wrapper">
                        <button class="notification_dropdown_btn dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/icon/bell.svg') }}" alt="notifications">
                            <div class="notification-count">{{ count(userNotification('unseen')) }}</div>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="title">
                                @if (count(userNotification('unseen')) > 0)
                                    {{ __('Notifications') }}
                                @else
                                    {{ __('No Notifications') }}
                                @endif
                            </li>
                            @foreach (userNotification('unseen') as $item)
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('notification.notification-mark-as-read', $item->id) }}">
                                        {{ $item->title }}
                                    </a>
                                </li>
                            @endforeach
                            @if (count(userNotification('unseen')) > 0)
                                <li class="see_all_notificaiton">
                                    <a class="dropdown-item"
                                       href="{{ route('notification.notification-mark-all-as-read') }}">
                                        {{ __('Mark all as read') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Language switcher -->
                    @if (!empty(getOption('show_language_switcher')) && getOption('show_language_switcher') == STATUS_ACTIVE)
                        <div class="dropdown flag_dropdown_wrapper">
                            <button class="flag_dropdown dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(selectedLanguage()?->flag) }}" alt=""
                                     class="flag-icon me-1">
                                <span>{{ selectedLanguage()?->language }}</span>
                            </button>
                            <ul class="dropdown-menu dashboared-table-dropdown">
                                @foreach (appLanguages() as $app_lang)
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ url('/local/' . $app_lang->iso_code) }}">
                                            <img src="{{ asset($app_lang->flag) }}" alt=""
                                                 class="flag-icon me-1">
                                            <span>{{ $app_lang->language }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- User dropdown -->
                    <div class="dropdown admin_dropdown">
                        <button class="dropdown-toggle profile_dropdown" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="admin_image"
                                 src="{{ asset(getFileUrl(auth()->user()->image)) }}"
                                 alt="{{ auth()->user()->name }}">
                            <div class="info">
                                <span class="wellcome">{{ __('Welcome') }}</span>
                                <div class="admin_name d-flex align-items-center">
                                    {{ auth()->user()->name }}
                                    <img src="{{ asset('assets/images/icon/angle-down.svg') }}" alt="arrow">
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <img src="{{ asset('assets/images/icon/userManagement.svg') }}" alt="user icon">
                                    <span>{{ __('Profile') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <img src="{{ asset('assets/images/icon/logout.svg') }}" alt="logout icon">
                                    <span>{{ __('Logout') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
