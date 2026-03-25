@extends('super_admin.layouts.app')
@push('title')
{{ $title }}
@endpush
@section('content')
<div class="p-30">
    <!-- Page title like setting.html -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Manage currency codes, symbols, and placement.') }}</p>
    </div>

    <!-- Settings layout like html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar -->
        <aside class="settings-sidebar">
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <input type="hidden" id="currency-route" value="{{ route('super_admin.setting.currencies.index') }}">

            <div class="dashboard-settings-card has-min-height">
                <div class="card-body">
                    <div class="d-flex flex-wrap item-title justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">{{ __('Currency Settings') }}</h5>
                        <button class="primary_button d-flex align-items-center gap-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#add-modal">
                            + {{ __('Add Currency') }}
                        </button>
                    </div>

                    <!-- Search like Languages (custom box, not DataTables default search) -->
                    <div class="dashboard_search_addNew_box mb-3">
                        <div class="serach_field_area">
                            <form action="#" id="currencySearchForm">
                                <div class="search_field">
                                    <img class="search-image" src="{{ asset('assets/images/icons/search.svg') }}"
                                        alt="search icon">
                                    <input type="text" placeholder="{{ __('Search Currencies...') }}" name="search"
                                        id="currencySearchInput">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dashboard_common_table table-responsive">
                        <table class="table zTable" id="commonDataTable">
                            <thead class="table-heading">
                                <tr>
                                    <th scope="col">
                                        <div>{{ __("SL#") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("Code") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("Symbol") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("Placement") }}</div>
                                    </th>
                                    <th scope="col">
                                        <div>{{ __("Action") }}</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content area end -->
<!-- Add Modal section start -->
<div class="modal fade " id="add-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('Add Currency') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax reset" action="{{ route('super_admin.setting.currencies.store') }}" method="post"
                data-handler="commonResponseForModal">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-row">
                                <div class="dashboard-form-group full-width mb-2">
                                    <label for="sf-select-currency-add" class="form-label">{{ __('Currency ISO Code') }}
                                        <span class="text-danger">*</span></label>
                                    <select id="sf-select-currency-add" class="primary-form-control"
                                        name="currency_code" required>
                                        @foreach(getCurrency() as $code => $currencyItem)
                                        <option value="{{ $code }}">{{ $currencyItem }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="dashboard-form-group full-width mb-2">
                                    <label for="symbol" class="form-label">{{ __('Symbol') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="symbol" id="symbol" placeholder="{{ __('Type Symbol') }}"
                                        class="primary-form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-row">
                                <div class="dashboard-form-group full-width mb-2">
                                    <label for="currency_placement" class="form-label">{{ __('Currency Placement') }}
                                        <span class="text-danger">*</span></label>
                                    <select class="select2-activate-without-search"
                                        id="currency_placement" name="currency_placement" required>
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="before">{{ __('Before Amount') }}</option>
                                        <option value="after">{{ __('After Amount') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="dashboard-form-group full-width">
                                    <label class="form-label d-block">{{ __('Current Currency') }}</label>
                                    <div class="form-check form-switch dashboard_common_switch">
                                        <input class="form-check-input" type="checkbox" name="current_currency" value="1" role="switch" id="current_currency">
                                        <label class="form-label mb-0" for="default">{{ __('Set as Current Currency') }}</label>
                                    </div>
                                    <!-- <label class="checkbox-container">
                                        <input type="checkbox" name="current_currency" value="1" id="current_currency">
                                        <span class="custom-box"></span>
                                        <span class="text">{{ __('Current Currency') }}</span>
                                    </label> -->
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer form-actions">
                    <button type="button" class="primary_button cancel" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="primary_button">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal section end -->
<!-- Edit Modal section start -->
<div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- Edit Modal section end -->
@endsection
@push('script')
<script src="{{asset('super_admin/js/currencies.js')}}"></script>
@endpush