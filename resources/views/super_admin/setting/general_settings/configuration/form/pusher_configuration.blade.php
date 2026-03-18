<div>
    <div class="modal-header">
        <h2>{{ __('Pusher Configuration') }}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <form class="ajax" action="{{ route('super_admin.setting.common.settings.update') }}" method="post"
        data-handler="commonResponseForModal">
        @csrf

        <div class="modal-body">
            <div class="row g-3">
                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="pusher_app_id" class="form-label">{{ __('Pusher App Id') }}</label>
                        <input type="text" name="pusher_app_id" id="pusher_app_id"
                            value="{{ getOption('pusher_app_id') }}" class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="pusher_app_key" class="form-label">{{ __('Pusher App Key') }}</label>
                        <input type="text" name="pusher_app_key" id="pusher_app_key"
                            value="{{ getOption('pusher_app_key') }}" class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="pusher_app_secret" class="form-label">{{ __('Pusher App Secret') }}</label>
                        <input type="text" name="pusher_app_secret" id="pusher_app_secret"
                            value="{{ getOption('pusher_app_secret') }}" class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="pusher_cluster" class="form-label">{{ __('Pusher Cluster') }}</label>
                        <input type="text" name="pusher_cluster" id="pusher_cluster"
                            value="{{ getOption('pusher_cluster') }}" class="primary-form-control">
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
