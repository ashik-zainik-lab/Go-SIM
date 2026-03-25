<div class="modal-header">
    <h2>{{ __('Update Currency') }}</h2>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="ajax reset" action="{{ route('super_admin.setting.currencies.update', $currency->id) }}" method="post"
    data-handler="commonResponseForModal">
    @csrf
    @method('PATCH')
    <div class="modal-body">
        <div class="row rg-15">
            <div class="col-12">
                <div class="form-row">
                    <div class="dashboard-form-group full-width mb-2">
                        <label for="currency_code" class="form-label">{{ __('Currency ISO Code') }} <span
                                class="text-danger">*</span></label>
                        <select class="sf-select-edit-modal primary-form-control" id="currency_code"
                            name="currency_code" required>
                            @foreach(getCurrency() as $code => $currencyItem)
                            <option value="{{ $code }}" {{ $code == $currency->currency_code ? 'selected' : '' }}>
                                {{ $currencyItem }}
                            </option>
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
                        <input type="text" class="primary-form-control" name="symbol"
                            placeholder="{{ __('Type symbol') }}" value="{{ $currency->symbol }}" required>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="dashboard-form-group full-width mb-2">
                        <label for="currency_placement" class="form-label">{{ __('Currency Placement') }} <span
                                class="text-danger">*</span></label>
                        <select class="common-select2-without-search" name="currency_placement"
                            required>
                            <option value="">--{{ __('Select Option') }}--</option>
                            <option {{ $currency->currency_placement == "before" ? 'selected' : '' }} value="before">
                                {{ __('Before Amount') }}
                            </option>
                            <option {{ $currency->currency_placement == "after" ? 'selected' : '' }} value="after">
                                {{ __('After Amount') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="dashboard-form-group full-width">
                        <label class="form-label d-block">{{ __('Current Currency') }}</label>
                            <div class="form-check form-switch dashboard_common_switch">
                                <input class="form-check-input" type="checkbox" name="current_currency" value="1"  role="switch"
                                 {{ $currency->current_currency == STATUS_ACTIVE ? 'checked' : '' }}
                                  id="current_currency_{{ $currency->id }}">
                                <label class="form-label mb-0" for="current_currency">{{ __('Set as Current Currency') }}</label>
                        </div>
                        <!-- <label class="checkbox-container">
                            <input type="checkbox" name="current_currency" value="1"
                                {{ $currency->current_currency == STATUS_ACTIVE ? 'checked' : '' }}
                                id="current_currency_{{ $currency->id }}">
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
            {{ __('Update') }}
        </button>
    </div>
</form>