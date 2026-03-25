<div class="modal-header">
    <h2>{{ __('Update Language') }}</h2>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="ajax reset" action="{{ route('super_admin.setting.languages.update', $language->id) }}" method="post"
    data-handler="commonResponseForModal" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <!-- Row 1 -->
        <div class="form-row">
            <div class="dashboard-form-group full-width mb-2">
                <label class="form-label">{{ __('Language') }} <span class="text-danger">*</span></label>
                <input type="text" class="primary-form-control" name="language" value="{{ $language->language }}"
                    required placeholder="{{ __('Type Language Name') }}">
            </div>
        </div>

        <!-- Row 2 -->
        <div class="form-row">
            <div class="dashboard-form-group full-width mb-2">
                <label class="form-label">{{ __('ISO Code') }} <span class="text-danger">*</span></label>
                <select name="iso_code" class="sf-select-with-search" id="sf-select-modal-edit" required>
                    <option value="">--{{ __('Select ISO Code') }}--</option>
                    @foreach(languageIsoCode() as $code => $isoCountryName)
                    <option value="{{$code}}" {{ $code==$language->iso_code ? 'selected' : ''
                        }}>{{ $isoCountryName.'('.$code.')' }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="form-row">
            <div class="dashboard-form-group full-width">
                <label class="form-label d-block">
                    {{ __('Flag') }}
                    <span class="text-mime-type">(jpeg,png,jpg,svg,webp)</span>
                    <span class="text-danger">*</span>
                </label>
                <div class="zImage-upload-details common-image-upload-box">
                    <div class="upload-img-box">
                        <img src="{{ getFileUrl($language->flag_id) }}" />
                        <input type="file" name="flag" id="flag" accept="image/*" onchange="previewFile(this)" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 4 -->
        <div class="form-row">
            <div class="dashboard-form-group full-width mb-2">
                <label class="form-label" for="rtl">{{ __('RTL Supported') }} <span class="text-danger">*</span></label>
                <select name="rtl" class="rtl-support-select-without-search" required>
                    <option {{ $language->rtl == 0 ? 'selected' : '' }} value="0">{{__("No")}}</option>
                    <option {{ $language->rtl == 1 ? 'selected' : '' }} value="1">{{__("Yes")}}</option>
                </select>
            </div>
        </div>

        <!-- Row 5 -->
        <div class="form-row">
            <div class="dashboard-form-group full-width">
                <label class="form-label d-block">{{ __('Default Language') }}</label>
                <div class="form-check form-switch dashboard_common_switch">
                    <input class="form-check-input" type="checkbox" name="default" value="1"
                        {{ $language->default == STATUS_ACTIVE ? 'checked' : '' }} role="switch" id="default">
                    <label class="form-label mb-0" for="default">{{ __('Set as default language') }}</label>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions mt-3">
            <button type="button" class="primary_button cancel" data-bs-dismiss="modal">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="primary_button">
                {{ __('Update Language') }}
            </button>
        </div>
    </div>
</form>