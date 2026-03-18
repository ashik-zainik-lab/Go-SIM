@extends('super_admin.layouts.app')
@push('title')
{{ $title }}
@endpush
@section('content')
<div class="p-30">
    <!-- Page title -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Configure where your files are stored and manage storage links.') }}</p>
    </div>

    <!-- Settings layout like html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar -->
        <aside class="settings-sidebar">
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <div class="dashboard-settings-card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Storage Settings') }}</h5>

                    <!-- Instructions -->
                    <div class="bg-dark-primary-soft-varient p-4 border-1 mb-3">
                        <h5>{{ __('Instructions') }}: </h5>
                        <p>{{ __('You need to click on') }}
                            <strong>{{ __(' "Storage Link"') }}</strong> {{ __(' button, after change ') }}
                            <strong>{{ __('"Storage Driver"') }}</strong>
                        </p>
                        <div class="text-black mt-3">
                            <a href="{{route('super_admin.setting.storage.link')}}"
                                class="fs-15 fw-500 lh-25 text-black py-10 px-26 bg-cdef84 bd-ra-12 hover-bg-one">
                                Storage
                                Link</a>
                        </div>
                    </div>

                    <!-- Form -->
                    <form class="ajax" action="{{route('super_admin.setting.storage.update')}}" method="POST"
                        enctype="multipart/form-data" data-handler="settingCommonHandler">
                        @csrf

                        <div class="row g-3">
                            <div class="col-xxl-4 col-lg-4 col-md-6">
                                <div class="dashboard-form-group">
                                    <label for="STORAGE_DRIVER" class="form-label">{{ __('Storage Driver') }}</label>
                                    <select name="STORAGE_DRIVER" id="storage_driver"
                                        class="form-control sf-select-without-search" required>
                                        <option value="{{ STORAGE_DRIVER_PUBLIC }}"
                                            {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_PUBLIC ?  'selected':'' }}>
                                            {{__('Public')}}</option>
                                        <option value="{{ STORAGE_DRIVER_AWS }}"
                                            {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_AWS ?  'selected':'' }}>
                                            {{__('AWS')}}</option>
                                        <option value="{{ STORAGE_DRIVER_WASABI }}"
                                            {{ env('STORAGE_DRIVER') == STORAGE_DRIVER_WASABI ?  'selected':'' }}>
                                            {{__('Wasabi')}}</option>
                                        <option value="{{ STORAGE_DRIVER_VULTR }}"
                                            {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_VULTR ?  'selected':'' }}>
                                            {{__('Vultr')}}</option>
                                        <option value="{{ STORAGE_DRIVER_DO }}"
                                            {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_DO ?  'selected':'' }}>
                                            {{__('Digital Ocean (DO)')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- AWS -->
                        <div class="d-none storage-driver mt-3" id="aws">
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('AWS Access Key ID') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="AWS_ACCESS_KEY_ID"
                                                value="{{ env('AWS_ACCESS_KEY_ID') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('AWS Secret Access Key') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="AWS_SECRET_ACCESS_KEY"
                                                value="{{ env('AWS_SECRET_ACCESS_KEY') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('AWS Default Region') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="AWS_DEFAULT_REGION"
                                                value="{{ env('AWS_DEFAULT_REGION') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('AWS Bucket') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="AWS_BUCKET" value="{{ env('AWS_BUCKET') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wasabi -->
                        <div class="d-none storage-driver mt-3" id="wasabi">
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('WAS Access Key ID') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="WASABI_ACCESS_KEY_ID"
                                                value="{{ env('WASABI_ACCESS_KEY_ID') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('WAS Secret Access Key') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="WASABI_SECRET_ACCESS_KEY"
                                                value="{{ env('WASABI_SECRET_ACCESS_KEY') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('WAS Default Region') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="WASABI_DEFAULT_REGION"
                                                value="{{ env('WASABI_DEFAULT_REGION') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('WAS Bucket') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="WASABI_BUCKET" value="{{ env('WASABI_BUCKET') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vultr -->
                        <div class="d-none storage-driver mt-3" id="vultr">
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('VULTR Access Key') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="VULTR_ACCESS_KEY_ID"
                                                value="{{ env('VULTR_ACCESS_KEY_ID') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('VULTR Secret Key') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="VULTR_SECRET_ACCESS_KEY"
                                                value="{{ env('VULTR_SECRET_ACCESS_KEY') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('VULTR Region') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="VULTR_DEFAULT_REGION"
                                                value="{{ env('VULTR_DEFAULT_REGION') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('VULTR Endpoint') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="VULTR_ENDPOINT" value="{{ env('VULTR_ENDPOINT') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('VULTR Bucket') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="VULTR_BUCKET" value="{{ env('VULTR_BUCKET') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Digital Ocean -->
                        <div class="d-none storage-driver mt-3" id="do">
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('DO Access Key ID') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="DO_ACCESS_KEY_ID"
                                                value="{{ env('DO_ACCESS_KEY_ID') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('DO Secret Access Key') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="DO_SECRET_ACCESS_KEY"
                                                value="{{ env('DO_SECRET_ACCESS_KEY') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('DO Default Region') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="DO_DEFAULT_REGION"
                                                value="{{ env('DO_DEFAULT_REGION') }}" class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('DO Bucket') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="DO_BUCKET" value="{{ env('DO_BUCKET') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('DO Folder') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="DO_FOLDER" value="{{ env('DO_FOLDER') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row input__group mb-25">
                                <label class="col-lg-3 p-25">{{ __('DO CDN ID') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <div class="primary-form-group mt-2">
                                        <div class="primary-form-group-wrap">
                                            <input type="text" name="DO_CDN_ID" value="{{ env('DO_CDN_ID') }}"
                                                class="primary-form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-end text-end">
                            <div class="col-12">
                                <div class="input__group general-settings-btn">
                                    <button type="submit" class="primary_button">
                                        {{__('Update')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('super_admin/js/storage-settings.js') }}"></script>
@endpush