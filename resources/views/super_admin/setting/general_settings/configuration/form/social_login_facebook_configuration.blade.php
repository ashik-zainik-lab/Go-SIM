<div>
    <div class="modal-header">
        <h2>{{ __('Social Login (Facebook) Configuration') }}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <form class="ajax" action="{{ route('super_admin.setting.common.settings.update') }}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf

        <div class="modal-body">
            <div class="row g-3">
                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="facebook_client_id" class="form-label">{{ __('Facebook Client ID') }}</label>
                        <input type="text" name="facebook_client_id" id="facebook_client_id"
                            value="{{ getOption('facebook_client_id') }}" class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="facebook_client_secret" class="form-label">{{ __('Facebook Client Secret') }}</label>
                        <input type="text" name="facebook_client_secret" id="facebook_client_secret"
                            value="{{ getOption('facebook_client_secret') }}" class="primary-form-control">
                    </div>
                </div>

                <div class="col-12">
                    <div class="dashboard-form-group">
                        <label class="form-label">
                            {{ __('Set callback URL') }} : <strong>{{ url('/auth/facebook/callback') }}</strong>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer form-actions">
            <button type="button" class="primary_button cancel" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="primary_button">{{ __('Save') }}</button>
        </div>
    </form>
</div>
