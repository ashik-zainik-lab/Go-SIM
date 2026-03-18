<div>
    <div class="modal-header">
        <h2>{{ __('Google analytics configuration') }}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <form class="ajax" action="{{ route('super_admin.setting.common.settings.update') }}" method="post"
        data-handler="commonResponseForModal">
        @csrf

        <div class="modal-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('Google Analytics Tracking Id') }}</label>
                        <input type="text" name="google_analytics_tracking_id"
                            value="{{ getOption('google_analytics_tracking_id') }}" class="primary-form-control">
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
