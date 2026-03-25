<div class="modal-header">
    <h2>{{ __('Edit User') }}</h2>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form method="POST" action="{{ route('super_admin.users.update', $user->id) }}" class="ajax reset modal-form"
        data-handler="commonResponseWithPageLoad">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-md-12">
                <div class="dashboard-form-group">
                    <label class="form-label">{{ __('Name') }}<span>*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="dashboard-form-group">
                    <label class="form-label">{{ __('Email') }}<span>*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="dashboard-form-group">
                    <label class="form-label">{{ __('Mobile') }}<span>*</span></label>
                    <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="dashboard-form-group">
                    <label class="form-label">{{ __('Status') }}<span>*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="{{ USER_STATUS_ACTIVE }}" @selected((int)$user->status === USER_STATUS_ACTIVE)>
                            {{ __('Active') }}
                        </option>
                        <option value="{{ USER_STATUS_INACTIVE }}" @selected((int)$user->status ===
                            USER_STATUS_INACTIVE)>
                            {{ __('Inactive') }}
                        </option>
                    </select>
                </div>
            </div>
        </div>





        <div class="form-actions">
            <button type="button" class="primary_button cancel" data-bs-dismiss="modal">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="primary_button">{{ __('Update') }}</button>
        </div>
    </form>
</div>