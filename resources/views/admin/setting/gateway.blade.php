@extends('admin.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <div class="dashboard-section-title">
            <h2 class="title">{{ __($title) }}</h2>
            <p>{{ __('Manage payment gateways, credentials, and conversion rates.') }}</p>
        </div>

        <div class="d-flex align-items-start settings-grid-container">
            <aside class="settings-sidebar">
                @include('admin.setting.partials.general-sidebar')
            </aside>

            <div class="settings-forms w-100">
                <div class="dashboard-settings-card has-min-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <h5 class="card-title mb-0">{{ __('Payment Settings') }}</h5>
                            <a title="{{ __('Sync missing gateway') }}"
                               href="{{ route('admin.setting.gateway.syncs') }}"
                               class="bd-ra-12 bg-cdef84 d-none d-sm-inline-block fs-15 fw-500 hover-bg-one lh-25 px-26 py-1 text-black"
                               onclick="return confirm('{{ __('Are you sure you want to sync gateways?') }}');">
                                <i class="fa fa-sync-alt"></i>
                            </a>
                        </div>

                        <div class="row g-3 mt-2">
                            @foreach ($gateways as $gateway)
                                <div class="col-xxl-3 col-lg-4 col-md-6">
                                    <div class="single-payment">
                                        <button class="dashboard-menu-dots" data-bs-toggle="dropdown"
                                                aria-expanded="false" type="button">
                                            <img src="{{ asset('assets/images/icons/dots.svg') }}" alt="dots">
                                        </button>
                                        <ul class="dropdown-menu dashboared-table-dropdown dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit" href="javascript:void(0)"
                                                   data-id="{{ $gateway->id }}">
                                                    <span>{{ __('Edit') }}</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <img class="payment-img" src="{{ asset($gateway->image) }}"
                                             alt="{{ $gateway->title }}">

                                        <div class="status {{ $gateway->status == ACTIVE ? 'active' : '' }}">
                                            {{ $gateway->status == ACTIVE ? __('Active') : __('Deactivate') }}
                                            @if ($gateway->slug != 'bank')
                                                - {{ $gateway->mode == GATEWAY_MODE_LIVE ? __('Live') : __('Sandbox') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="fw-500 text-black">{{ $gateway->title }}</div>
                                        <div class="fs-12 text-muted">{{ $gateway->slug }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="editModalLabel">{{ __('Edit Gateway') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <form class="ajax" action="{{ route('admin.setting.gateway.store') }}" method="POST"
                data-handler="responseOnGatewaStore">
                @csrf
                <input type="hidden" name="id" id="id" required>
                <div class="modal-body">
                    <div class="bg-white theme-border radius-4 p-20">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="upload-profile-photo-box mb-0">
                                <div class="profile-user position-relative d-inline-block">
                                    <img src="" class="image" alt="{{ __('Gateway') }}">
                                </div>
                            </div>
                            <div>
                                <div class="fw-600 text-black">{{ __('Gateway') }}</div>
                                <div class="fs-12 text-muted">{{ __('Update gateway credentials and conversion rates.') }}</div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Title') }}</label>
                                    <input type="text" class="primary-form-control title" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Slug') }}</label>
                                    <input type="text" name="slug" class="primary-form-control slug" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select name="status" id="status"
                                        class="primary-form-control sf-select-without-search">
                                        <option value="0">{{ __('Deactivate') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mode-div">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Mode') }}</label>
                                    <select name="mode" id="mode"
                                        class="primary-form-control sf-select-without-search">
                                        <option value="1">{{ __('Live') }}</option>
                                        <option value="2">{{ __('Sandbox') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bank-div">
                            <div class="bank-div-append">

                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="button"
                                        class="primary_button add-bank"
                                        title="{{ __('Add Bank') }}">
                                        <span class="iconify" data-icon="material-symbols:add"></span> {{ __('Add Bank') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row url-div">
                            <div class="col-md-12 gateway-input" id="gateway-url">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Url') }} / {{ __('Hash') }}</label>
                                    <input class="primary-form-control" type="text" name="url">
                                </div>
                            </div>
                        </div>
                        <div class="row key-secret-div">
                            <div class="col-md-12 gateway-input" id="gateway-key">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Key') }}</label>
                                    <input class="primary-form-control" type="text" name="key">
                                </div>
                                <small class="d-none small">{{ __('Client id, Public Key, Key, Store id, Api Key')
                                    }}</small>
                            </div>
                            <div class="col-md-12 gateway-input" id="gateway-secret">
                                <div class="dashboard-form-group">
                                    <label class="form-label">{{ __('Secret') }}</label>
                                    <input class="primary-form-control" type="text" name="secret">
                                </div>
                                <small class="d-none small">{{ __('Client Secret, Secret, Store Password, Auth Token')
                                    }}</small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <label class="form-label mb-0">{{ __('Conversion Rate') }}</label>
                                    <button type="button" class="primary_button add-currency">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" d="M5.5 10.5h10m-5-5v10" />
                                        </svg>
                                        {{ __('Add') }}
                                    </button>
                                </div>
                                <div id="currencyConversionRateSection" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="primary_button cancel" data-bs-dismiss="modal"
                        title="{{ __('Back') }}">{{ __('Back') }}</button>
                    <button type="submit" class="primary_button" title="{{ __('Submit') }}">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="getInfoRoute" value="{{ route('admin.setting.gateway.get.info') }}">
<input type="hidden" id="getCurrencySymbol" value="{{ getCurrencySymbol() }}">
<input type="hidden" id="allCurrency" value="{{ json_encode(getCurrency()) }}">
<input type="hidden" id="gatewaySettings" value="{{ gatewaySettings() }}">
<input type="hidden" id="supportedCurrency" value="{{json_encode(getGatewaySupportedCurrencies())}}">
@endsection
@push('script')
    <script src="{{ asset('admin/js/gateway.js') }}"></script>
@endpush
