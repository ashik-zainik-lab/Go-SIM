<div class="modal-header">
    <h2>{{ __('Edit Country') }}</h2>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form method="POST"
        action="{{ route('super_admin.destinations.countries.update', $country->id) }}"
        class="ajax reset modal-form" data-handler="commonResponseWithPageLoad">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="dashboard-form-group">
                <label class="form-label">{{ __('Country Name') }}<span class="text-danger">*</span></label>
                <select name="country_name" class="form-control sf-select-edit-modal" required>
                    @foreach ($countryOptions as $code => $countryName)
                    <option value="{{ $countryName }}"
                        {{ strtoupper($country->country_name) === strtoupper($countryName) ? 'selected' : '' }}>
                        {{ $countryName }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="dashboard-form-group">
                <label class="form-label">{{ __('ISO Code') }}<span class="text-danger">*</span></label>
                <select name="short_name" class="form-control sf-select-edit-modal" required>
                    @foreach($countryOptions as $code => $countryName)
                    <option value="{{ strtoupper($code) }}"
                        {{ strtoupper($country->short_name) === strtoupper($code) ? 'selected' : '' }}>
                        {{ $countryName.'('.strtoupper($code).')' }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="dashboard-form-group">
                <label class="form-label">{{ __('Assign to Region') }}<span class="text-danger">*</span></label>
                <select name="region_id" class="form-control sf-select-edit-modal" required>
                    @foreach ($regions as $region)
                    <option value="{{ $region->id }}"
                        {{ (int)$country->region_id === (int)$region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="dashboard-form-group">
                <label class="form-label">{{ __('Status') }}<span class="text-danger">*</span></label>
                <select name="status" class="form-control sf-select-edit-modal" required
                    data-minimum-results-for-search="Infinity">
                    <option value="{{ STATUS_ACTIVE }}" @selected($country->status == STATUS_ACTIVE)>
                        {{ __('Active') }}
                    </option>
                    <option value="{{ STATUS_INACTIVE }}" @selected($country->status == STATUS_INACTIVE)>
                        {{ __('Inactive') }}
                    </option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="primary_button cancel" data-bs-dismiss="modal">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="primary_button">{{ __('Update') }}</button>
        </div>
    </form>
</div>

