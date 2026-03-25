<div>
    <div class="modal-header">
        <h3>{{ __('Mail Configuration') }}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <form class="ajax" action="{{ route('super_admin.setting.settings_env.update') }}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf

        <div class="modal-body">
            <div class="d-flex justify-content-end mb-3">
                <button type="button" id="sendTestMailBtn" class="primary_button">
                    <i class="fa fa-envelope"></i> {{ __('Send Test Mail') }}
                </button>
            </div>

            <div class="row g-3">
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL MAILER') }} <span class="text-danger">*</span></label>
                        <input type="text" name="MAIL_MAILER" value="{{ env('MAIL_MAILER') }}"
                            class="primary-form-control">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL HOST') }} <span class="text-danger">*</span></label>
                        <input type="text" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}" class="primary-form-control">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL PORT') }} <span class="text-danger">*</span></label>
                        <input type="text" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}" class="primary-form-control">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL USERNAME') }} <span class="text-danger">*</span></label>
                        <input type="text" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}"
                            class="primary-form-control">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL PASSWORD') }} <span class="text-danger">*</span></label>
                        <input type="password" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}"
                            class="primary-form-control">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label for="MAIL_ENCRYPTION" class="form-label">{{ __('MAIL ENCRYPTION') }} <span
                                class="text-danger">*</span></label>
                        <select name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" class="form-control sf-select">
                            <option value="tls" {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>
                                {{ __('tls') }}
                            </option>
                            <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                                {{ __('ssl') }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL FROM ADDRESS') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}"
                            class="primary-form-control">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">{{ __('MAIL FROM NAME') }} <span class="text-danger">*</span></label>
                        <input type="text" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}"
                            class="primary-form-control">
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