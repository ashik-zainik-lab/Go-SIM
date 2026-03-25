@extends('super_admin.layouts.app')
@push('title')
{{ $title }}
@endpush

@section('content')
<div class="p-30">
    <input type="hidden" id="destination-route" value="{{ route('super_admin.destinations.index') }}">

    <div class="dashboard-section-title">
        <h2 class="title">{{ __('Destinations') }}</h2>
        <p>{{ __('Manage global service zones, regions, and country-specific connectivity.') }}</p>
    </div>

    <ul class="nav dashboard_common_tabs" id="destinationTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="regions-tab" data-bs-toggle="tab" data-bs-target="#regions-pane"
                type="button" role="tab" aria-controls="regions-pane" aria-selected="true">{{ __('Regions') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="countries-tab" data-bs-toggle="tab" data-bs-target="#countries-pane"
                type="button" role="tab" aria-controls="countries-pane"
                aria-selected="false">{{ __('Countries') }}</button>
        </li>
    </ul>

    <div class="tab-content" id="destinationTabContent">
        <div class="tab-pane fade show active" id="regions-pane" role="tabpanel" aria-labelledby="regions-tab">
            <div class="dashboard_search_addNew_box">
                <div class="serach_field_area">
                    <form action="#" id="regionSearchForm">
                        <div class="search_field">
                            <img class="search-image" src="{{ asset('assets/images/icons/search.svg') }}"
                                alt="search icon">
                            <input type="text" placeholder="{{ __('Search regions...') }}" id="regionSearchInput"
                                name="search">
                        </div>
                    </form>
                </div>
                <button type="button" class="primary_button" data-bs-toggle="modal"
                    data-bs-target="#addNewRegionModal">+ {{ __('Add Region') }}</button>
            </div>

            <div class="region-grid" id="region-card-wrap">
                @foreach ($regionCards as $region)
                <div class="region_card">
                    <div class="cards-header">
                        <div class="icon-container">
                            <img src="{{ getRegionIcon($region->icon) }}" alt="maps icon">
                        </div>
                        <button class="dashboard-menu-dots" data-bs-toggle="dropdown" aria-expanded="false"
                            type="button">
                            <img src="{{ asset('assets/images/icons/dots.svg') }}" alt="dots">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)"
                                    onclick="getEditModal('{{ route('super_admin.destinations.regions.edit', $region->id) }}', '#edit-modal')">
                                    <span>{{ __('Edit') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)"
                                    onclick="deleteItem('{{ route('super_admin.destinations.regions.delete', $region->id) }}', 'countryDataTable')">
                                    <span>{{ __('Delete') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="cards-body">
                        <h2 class="title">{{ $region->name }}</h2>
                        <div class="subtitle">
                            <span class="globe-icon"><img src="{{ asset('assets/images/icons/earth.svg') }}" width="10"
                                    height="10" alt="icon"></span> {{ $region->code }}
                        </div>
                    </div>
                    <div class="cards-footer">
                        <div class="state">
                            <label>{{ __('Countries') }}</label>
                            <div class="value">{{ $region->countries()->count() }}</div>
                        </div>
                        <div class="state">
                            <label>{{ __('Active Plans
                                        ') }}</label>
                            <div class="value">{{ getStatus($region->status) }}</div>
                        </div>
                        <div
                            class="dashboared-status-badge {{ $region->status == STATUS_ACTIVE ? 'active' : 'pending' }}">
                            {{ $region->status == STATUS_ACTIVE ? __('ACTIVE') : __('INACTIVE') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade" id="countries-pane" role="tabpanel" aria-labelledby="countries-tab">
            <div class="dashboard_search_addNew_box">
                <div class="serach_field_area">
                    <form action="#" id="countrySearchForm">
                        <div class="search_field">
                            <img class="search-image" src="{{ asset('assets/images/icons/search.svg') }}"
                                alt="search icon">
                            <input type="text" placeholder="{{ __('Search Countries...') }}" id="countrySearchInput"
                                name="search">
                        </div>
                    </form>
                </div>
                <button type="button" class="primary_button" data-bs-toggle="modal" data-bs-target="#addCountryModal">+
                    {{ __('Add Country') }}</button>
            </div>

            <div class="dashboard_common_table table-responsive">
                <table class="table zTable" id="countryDataTable">
                    <thead class="table-heading">
                        <tr>
                            <th>{{ __('SL#') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('ISO Code') }}</th>
                            <th>{{ __('Region') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade dashboard-common-modal" id="addNewRegionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('Add New Global Region') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="ajax reset modal-form" action="{{ route('super_admin.destinations.regions.store') }}"
                    method="POST" enctype="multipart/form-data" data-handler="commonResponseWithPageLoad">
                    @csrf

                    <div class="form-row">
                        <div class="dashboard-form-group">
                            <label>{{ __('Region Name') }}<span>*</span></label>
                            <select name="name" required class="select2-activate" id="regionNameSelect">
                                <option value="" selected disabled>{{ __('Select region name...') }}</option>
                                @foreach ($regionOptions as $regionKey => $regionName)
                                <option value="{{ $regionName }}" data-region-code="{{ $regionKey }}">
                                    {{ $regionName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="dashboard-form-group">
                            <label>{{ __('Unique Code') }}<span>*</span></label>
                            <select name="code" required class="select2-activate" id="regionCodeSelect">
                                <option value="" selected disabled>{{ __('Select unique code...') }}</option>
                                @foreach ($regionOptions as $regionKey => $regionName)
                                <option value="{{ $regionKey }}">{{ $regionKey }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="dashboard-form-group full-width no-gap common_editor_block">
                            <label>{{ __('Description') }}<span>*</span></label>
                            <div id="quill-editor" style="height: 280px;"></div>
                            <input type="hidden" name="description" id="description-input">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="dashboard-form-group">
                            <label>{{ __('Initial Status') }}<span>*</span></label>
                            <select name="status" required class="select2-activate">
                                <option value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
                                <option value="{{ STATUS_INACTIVE }}">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="dashboard-form-group">
                                <label>{{ __('Region Icon') }}</label>
                                <input type="file" name="icon" accept="image/*">
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="button" class=" primary_button cancel"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="primary_button">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade dashboard-common-modal" id="addCountryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('Add New Country') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax reset" action="{{ route('super_admin.destinations.countries.store') }}" method="POST"
                data-handler="commonResponseWithPageLoad">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="dashboard-form-group">
                            <label>{{ __('Country Name') }}<span>*</span></label>
                            <select name="country_name" class="select2-activate" required>
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach ($countryOptions as $code => $countryName)
                                <option value="{{ strtoupper($code) }}">{{ $countryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="dashboard-form-group ">
                                <label class="form-label">{{ __('ISO Code') }} <span
                                        class="text-danger">*</span></label>
                                <select name="short_name" class="select2-activate" id="sf-select-modal-add" required>
                                    <option value="">--{{ __('Select ISO Code') }}--</option>
                                    @foreach(languageIsoCode() as $code => $isoCountryName)
                                    <option value="{{$code}}">{{ $isoCountryName.'('.$code.')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="dashboard-form-group ">
                            <label>{{ __('Assign to Region') }}<span>*</span></label>
                            <select name="region_id" required class="select2-activate">
                                <option value="" selected disabled>{{ __('Select a region...') }}</option>
                                @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="dashboard-form-group">
                            <label>{{ __('Status') }}<span>*</span></label>
                            <select name="status" required class="select2-activate"
                                data-minimum-results-for-search="Infinity">
                                <option value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
                                <option value="{{ STATUS_INACTIVE }}">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                    </div>


                    <div class="form-actions">
                        <button type="button" class="primary_button cancel"
                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="primary_button">{{ __('Add Country') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade dashboard-common-modal" id="edit-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('super_admin/js/destinations.js') }}"></script>
@endpush