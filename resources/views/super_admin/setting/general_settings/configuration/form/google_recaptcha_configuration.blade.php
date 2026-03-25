<div>
    <div class="modal-header">
        <h5>{{ __('Google Recaptcha Credentials') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <form class="ajax" action="{{ route('super_admin.setting.common.settings.update') }}" method="post"
        data-handler="commonResponseForModal">
        @csrf

        <div class="modal-body">
            <div class="row g-3">
                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="google_recaptcha_site_key"
                            class="form-label">{{ __('Google Recaptcha Site Key') }}</label>
                        <input type="text" name="google_recaptcha_site_key" id="google_recaptcha_site_key"
                            value="{{ getOption('google_recaptcha_site_key') }}" class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="google_recaptcha_secret_key"
                            class="form-label">{{ __('Google Recaptcha Secret Key') }}</label>
                        <input type="text" name="google_recaptcha_secret_key" id="google_recaptcha_secret_key"
                            value="{{ getOption('google_recaptcha_secret_key') }}" class="primary-form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer form-actions">
            <button type="button" class="primary_button cancel" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="primary_button">{{ __('Update') }}</button>
        </div>
    </form>
</div>