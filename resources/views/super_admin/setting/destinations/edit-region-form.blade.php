<form method="POST" action="{{ route('super_admin.setting.destinations.regions.update', $region->id) }}"
    enctype="multipart/form-data" class="ajax reset modal-form" data-handler="commonResponseWithPageLoad">
    @csrf
    @method('PATCH')

    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('Region Name') }}</label>
                <select name="name" class="form-control sf-select-edit-modal" required id="editRegionNameSelect">
                    <option value="" disabled>{{ __('Select region name...') }}</option>
                    @foreach ($regionOptions as $regionKey => $regionName)
                        <option value="{{ $regionName }}" data-region-code="{{ $regionKey }}"
                            {{ $region->name === $regionName ? 'selected' : '' }}>
                            {{ $regionName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('Code') }}</label>
                <select name="code" class="form-control sf-select-edit-modal" required id="editRegionCodeSelect">
                    <option value="" disabled>{{ __('Select unique code...') }}</option>
                    @foreach ($regionOptions as $regionKey => $regionName)
                        @php($optionCode = $regionKey)
                        <option value="{{ $optionCode }}" {{ $region->code === $optionCode ? 'selected' : '' }}>
                            {{ $optionCode }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <div class="dashboard-form-group full-width no-gap common_editor_block">
                    <label class="form-label">{{ __('Description') }}<span>*</span></label>
                    <textarea name="description" id="description-input" class="primary-form-control"
                        rows="5">{{ $region->description }}</textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">{{ __('Region Icon') }}</label>
                <input type="file" name="icon" class="form-control" accept="image/*">
                @if($region->icon)
                    <div class="mt-2">
                        <img src="{{ getRegionIcon($region->icon) }}" alt="region icon" style="width: 36px; height: 36px; object-fit: cover;">
                    </div>
                @endif
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('Sort Order') }}</label>
                <input type="number" name="sort_order" class="form-control" value="{{ $region->sort_order }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('Status') }}</label>
                <select name="status" class="form-control">
                    <option value="{{ STATUS_ACTIVE }}" @selected($region->status == STATUS_ACTIVE)>{{ __('Active') }}
                    </option>
                    <option value="{{ STATUS_INACTIVE }}" @selected($region->status ==
                        STATUS_INACTIVE)>{{ __('Inactive') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="button" class="common_button btn-cancel" data-bs-dismiss="modal">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="common_button add_new_button">
            {{ __('Update') }}
        </button>
    </div>
</form>