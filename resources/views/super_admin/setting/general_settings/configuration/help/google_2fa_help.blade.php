<div>
    <div class="modal-header">
        <h2>{{ __('Google 2fa') }}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <div class="modal-body">
        <div class="row g-3">
            <div class="col-12">
                <div class="dashboard-form-group">
                    <p class="mb-0">
                        {{ __('If you enable this. The system will enable for google 2fa. By wearing it you will know how this setting works .') }}
                    </p>
                </div>
            </div>
            <div class="col-12">
                <a class="primary_button" target="_blank" rel="noopener noreferrer"
                    href="https://zaialumni-doc.zainikthemes.com/configurable.html#google_2fa">
                    {{ __('View the documentation') }}
                </a>
            </div>
        </div>
    </div>

    <div class="modal-footer form-actions">
        <button type="button" class="primary_button cancel" data-bs-dismiss="modal">{{ __('Close') }}</button>
    </div>
</div>
