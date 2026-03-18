@extends('super_admin.layouts.app')
@push('admin-style')
<link rel="stylesheet" href="{{ asset('super_admin/styles/main.css') }}">
@endpush
@push('title')
{{ $title }}
@endpush
@section('content')
<div class="dashboard-section-title">
    <h2 class="title">{{ __($title) }}</h2>
    <p>{{ __('Track transactions, monitor activations, and manage refunds.') }}</p>
</div>

<input type="hidden" id="statusChangeRoute" value="{{ route('super_admin.setting.configuration-settings.update') }}">
<input type="hidden" id="configureUrl" value="{{ route('super_admin.setting.configuration-settings.configure') }}">
<input type="hidden" id="helpUrl" value="{{ route('super_admin.setting.configuration-settings.help') }}">

<!-- Settings Start -->
<div class="settings-grid-container">
    <div class="dashboard-settings-card">
        <form class="ajax" action="{{ route('super_admin.setting.configuration-settings.update') }}" method="POST"
            enctype="multipart/form-data" data-handler="settingCommonHandler">
            @csrf

            <!-- Common Table Start-->
            <div class="dashboard_common_table table-responsive">
                <table class="table">
                    <thead class="table-heading">
                        <tr>
                            <th class="col-6" scope="col">{{ __('Extension') }}</th>
                            <th class="col-4" scope="col">{{ __('Status') }}</th>
                            <th class="col-2" scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                {{ __('Email Verification') }}
                                <div class="label-text">
                                    ({{ __('If you enable Email Verification, new user have to verify the email to access this system.') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'email_verification_status')"
                                        value="1" {{ getOption('email_verification_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="email_verification_status" type="checkbox" role="switch"
                                        id="email_verification_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    @if(!isAddonInstalled('ALUSAAS'))
                                        <button type="button" class="primary_button"
                                            onclick="configureModal('email_verification_status')">
                                            {{ __('Configure') }}
                                        </button>
                                    @endif
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('email_verification_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('E-mail credentials status') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for sending email') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'app_mail_status')"
                                        value="1" {{ getOption('app_mail_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="app_mail_status" type="checkbox" role="switch" id="app_mail_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    @if(!isAddonInstalled('ALUSAAS'))
                                        <button type="button" class="primary_button"
                                            onclick="configureModal('app_mail_status')">
                                            {{ __('Configure') }}
                                        </button>
                                    @endif
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('app_mail_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('SMS credentials status') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for sending sms') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'app_sms_status')"
                                        value="1" {{ getOption('app_sms_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="app_sms_status" type="checkbox" role="switch" id="app_sms_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('app_sms_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('app_sms_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Pusher credentials status') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for pusher') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'pusher_status')"
                                        value="1" {{ getOption('pusher_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="pusher_status" type="checkbox" role="switch" id="pusher_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('pusher_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('pusher_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Social Login (Google)') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for Google. User can use our gmail account and sign in') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'google_login_status')"
                                        value="1" {{ getOption('google_login_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="google_login_status" type="checkbox" role="switch" id="google_login_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('google_login_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('google_login_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Social Login (Facebook)') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for Facebook. User can use our facebook account and sign in') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'facebook_login_status')"
                                        value="1" {{ getOption('facebook_login_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="facebook_login_status" type="checkbox" role="switch"
                                        id="facebook_login_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('facebook_login_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('facebook_login_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Google Recaptcha Credentials') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for google recaptcha credentials') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'google_recaptcha_status')"
                                        value="1" {{ getOption('google_recaptcha_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="google_recaptcha_status" type="checkbox" role="switch"
                                        id="google_recaptcha_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('google_recaptcha_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('google_recaptcha_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Google Analytics') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for google analytics.') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'google_analytics_status')"
                                        value="1" {{ getOption('google_analytics_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="google_analytics_status" type="checkbox" role="switch"
                                        id="google_analytics_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('google_analytics_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('google_analytics_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Cookie Consent') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for cookie consent settings. User Can manage cookie consent setting') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'cookie_status')"
                                        value="1" {{ getOption('cookie_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="cookie_status" type="checkbox" role="switch" id="cookie_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button"
                                        onclick="configureModal('cookie_status')">
                                        {{ __('Configure') }}
                                    </button>
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('cookie_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Google 2fa') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for google 2fa. By wearing it you will know how this setting works') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'two_factor_googleauth_status')"
                                        value="1" {{ getOption('two_factor_googleauth_status', 0)==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="two_factor_googleauth_status" type="checkbox" role="switch"
                                        id="two_factor_googleauth_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('two_factor_googleauth_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Preloader') }}
                                <div class="label-text">
                                    ({{ __('If you enable preloader, the preloader will be show before load the content.') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'app_preloader_status')"
                                        value="1" {{ getOption('app_preloader_status')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="app_preloader_status" type="checkbox" role="switch" id="app_preloader_status">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('app_preloader_status')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Show Language Switcher') }}
                                <div class="label-text">
                                    ({{ __('If you enable this. The system will enable for show language switcher. By wearing it you will know how this setting works.') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'show_language_switcher')"
                                        value="1" {{ getOption('show_language_switcher')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="show_language_switcher" type="checkbox" role="switch" id="show_language_switcher">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button cancel"
                                        onclick="helpModal('show_language_switcher')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('App Debug') }}
                                <div class="label-text">
                                    ({{ __('If you enable this.No warning message will be shown for any error. By wearing it you will know how this setting works.') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'app_debug')"
                                        value="1" {{ getOption('app_debug')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="app_debug" type="checkbox" role="switch" id="app_debug">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button cancel" onclick="helpModal('app_debug')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                {{ __('Force SSL') }}
                                <div class="label-text">
                                    ({{ __('If you enable this Force SSL will be enable.') }})
                                </div>
                            </th>
                            <td>
                                <div class="form-check form-switch dashboard_common_switch">
                                    <input class="form-check-input" onchange="changeSettingStatus(this,'force_ssl')"
                                        value="1" {{ getOption('force_ssl')==STATUS_ACTIVE ? 'checked' : '' }}
                                        name="force_ssl" type="checkbox" role="switch" id="force_ssl">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="primary_button cancel" onclick="helpModal('force_ssl')">
                                        {{ __('Help') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Common Table End-->
        </form>
    </div>
</div>
<!-- Settings End -->

<!-- Configuration section start -->
<div class="modal fade main-modal" id="configureModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">

        </div>
    </div>
</div>

<!-- Configuration section end -->
<!-- Help section start -->
<div class="modal fade main-modal" id="helpModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xs modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">

        </div>
    </div>
</div>
<!-- Help section end -->

<!-- Test Email section start -->
<div class="modal fade" id="sendTestMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Test Mail') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('super_admin.setting.mail.test') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 text-black">
                        <label for="to" class="col-form-label">{{ __('Recipient') }}:</label>
                        <input type="email" name="to" class="form-control" id="to"
                            placeholder="{{ __('Recipient Mail') }}" required>
                    </div>
                    <div class="mb-3 text-black">
                        <label for="to" class="col-form-label">{{ __('Subject') }}:</label>
                        <input type="text" name="subject" class="form-control" id="to" placeholder="{{ __('Subject') }}"
                            value="Test Mail" required>
                    </div>
                    <div class="mb-3 text-black">
                        <label for="message" class="col-form-label">{{ __('Your Message') }}:</label>
                        <textarea name="message" class="form-control" id="message-text">{{ __('Hi, This is a test mail')
                            }}</textarea>
                    </div>
                </div>
                <div class="modal-footer button__list">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit"
                        class="border-0 fs-15 fw-500 lh-25 text-black py-10 px-26 bg-cdef84 bd-ra-12 hover-bg-one mx-2">{{
                        __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- TEST EMail section end -->

<!-- TEST SMS section start -->
<div class="modal fade" id="sendTestSMS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Test SMS') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax reset" action="{{ route('super_admin.setting.sms.test') }}" method="post"
                enctype="multipart/form-data" data-handler="commonResponseForModal">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 text-black">
                        <label for="to" class="col-form-label">{{ __('Recipient Number') }}:</label>
                        <input type="text" name="to" class="form-control" id="to"
                            placeholder="{{ __('Recipient Number') }}" required>
                    </div>
                    <div class="mb-3 text-black">
                        <label for="message" class="col-form-label">{{ __('Your Message') }}:</label>
                        <textarea name="message" class="form-control" id="message-text">{{ __('Hi, This is a test sms')
                            }}</textarea>
                    </div>
                </div>
                <div class="modal-footer button__list">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit"
                        class="border-0 fs-15 fw-500 lh-25 text-black py-10 px-26 bg-cdef84 bd-ra-12 hover-bg-one mx-2">{{
                        __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- TEST SMS section end -->
@endsection
@push('script')
<script src="{{ asset('super_admin/js/configuration.js') }}"></script>
@endpush