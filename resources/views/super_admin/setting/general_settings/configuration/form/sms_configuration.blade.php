<div>
    <div class="modal-header">
        <h5>{{ __('SMS Configuration') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
    </div>

    <form class="ajax reset" action="{{ route('super_admin.setting.sms-configuration') }}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf

        <div class="modal-body">
            <!-- <div class="d-flex justify-content-end mb-3">
                <a href="javascript:void(0);" id="sendTestSMSBtn"
                    class="fs-15 fw-500 lh-25 text-black py-10 px-26 bg-cdef84 bd-ra-12 hover-bg-one">
                    <i class="primary_button"></i> {{ __('Send Test SMS') }}
                </a>
            </div> -->

            <div class="row g-3">
                <div class="col-xxl-4 col-lg-4 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">
                            {{ __('TWILIO ACCOUNT SID') }} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="TWILIO_ACCOUNT_SID" value="{{ getOption('TWILIO_ACCOUNT_SID') }}"
                            class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">
                            {{ __('TWILIO AUTH TOKEN') }} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="TWILIO_AUTH_TOKEN" value="{{ getOption('TWILIO_AUTH_TOKEN') }}"
                            class="primary-form-control">
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-md-6">
                    <div class="dashboard-form-group">
                        <label class="form-label">
                            {{ __('TWILIO PHONE NUMBER') }} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="TWILIO_PHONE_NUMBER" value="{{ getOption('TWILIO_PHONE_NUMBER') }}"
                            class="primary-form-control">
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