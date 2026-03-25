@extends('super_admin.layouts.app')
@push('title')
{{$title}}
@endpush
@section('content')
<div class="p-30">
    <!-- Page title like setting.html -->
    <div class="dashboard-section-title">
        <h2 class="title">{{ __($title) }}</h2>
        <p>{{ __('Translate keywords and manage language files.') }}</p>
    </div>

    <!-- Settings layout like html/setting.html -->
    <div class="d-flex align-items-start settings-grid-container">
        <!-- Left sidebar -->
        <aside class="settings-sidebar">
            @include('super_admin.setting.partials.general-sidebar')
        </aside>

        <!-- Right content -->
        <div class="settings-forms w-100">
            <input type="hidden" id="language-route" value="{{ route('super_admin.setting.languages.index') }}">
            <div class="dashboard-settings-card has-min-height">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 item-title justify-content-end mb-3">
                        <a class="primary_button"
                            href="{{route('super_admin.setting.languages.download', $language->id)}}"
                            title="{{ __('Download File') }}">
                            {{ __('Download File') }}
                        </a>
                        <button type="button" class="primary_button" data-bs-toggle="modal" data-bs-target="#importFile"
                            title="{{ __('Import File') }}">
                            {{ __('Import File') }}
                        </button>
                        <button type="button" class="primary_button" data-bs-toggle="modal"
                            data-bs-target="#importModal" title="{{ __('Import Keywords') }}">
                            {{__('Import Keywords')}}
                        </button>
                    </div>

                    <!-- Search + Add button (from plans.html design) -->
                    <div class="dashboard_search_addNew_box mb-3">
                        <div class="serach_field_area">
                            <form id="search-form">
                                <div class="search_field">
                                    <img class="search-image" src="{{ asset('assets/images/icons/search.svg') }}"
                                        alt="search icon">
                                    <input type="text" name="search" placeholder="{{__('Search Key or Value')}}">
                                </div>
                            </form>
                        </div>
                        <button type="button" class="primary_button addmore">
                            + {{__('Add More')}}
                        </button>
                    </div>

                    <div id="translations-container">
                        @include('super_admin.setting.languages.partials.translations_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal section start -->
<div class="modal fade dashboard-common-modal" id="importModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">
            <form class="ajax" action="{{ route('super_admin.setting.languages.import') }}" method="POST"
                data-handler="languageHandler">
                @csrf
                <input type="hidden" name="current" value="{{ $language->iso_code }}">
                <div class="modal-header">
                    <h2 class="modal-title">{{ __('Import Language') }}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-inner-form-box">
                        <div class="mb-25 text-center">
                            <span class="text-danger d-inline-block">
                                {{ __('Note: If you import keywords, your current keywords will be deleted and replaced by the imported keywords.') }}
                            </span>
                        </div>

                        <div class="dashboard-form-group mb-25">
                            <label for="importLanguage" class="form-label">
                                {{ __('Language') }} <span class="text-danger">*</span>
                            </label>
                            <select name="import" class="sf-select primary-form-control modal-input-sm"
                                id="importLanguage" required>
                                <option value=""> {{ __('Select Option') }} </option>
                                @foreach ($languages as $lang)
                                <option value="{{ $lang->iso_code }}">{{ __($lang->language) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start border-0 pt-0">
                    <button type="button" class="common_button btn-cancel" data-bs-dismiss="modal"
                        title="Back">{{ __('Back') }}</button>
                    <button type="submit" class="primary_button" title="Submit">{{ __('Import') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade dashboard-common-modal" id="importFile" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">
            <form class="ajax" action="{{ route('super_admin.setting.languages.upload', $language->id) }}" method="POST"
                enctype="multipart/form-data" data-handler="languageHandler">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title">{{ __('Upload Translated File') }}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-30 text-center">
                        <span class="text-warning">
                            {{ __('Upload a valid JSON translation file. Existing translations will be merged with the uploaded file. Keys in the uploaded file will overwrite existing keys.') }}
                        </span>
                    </div>
                    <div class="dashboard-form-group mb-25">
                        <label for="translationJsonFile" class="form-label">
                            {{ __('Select JSON File') }}
                        </label>
                        <input type="file" name="file" id="translationJsonFile"
                            class="primary-form-control modal-input-sm" accept=".json" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-start border-0 pt-0">
                    <button type="button" class="common_button btn-cancel" data-bs-dismiss="modal"
                        title="Back">{{ __('Back') }}</button>
                    <button type="submit" class="primary_button" title="Submit">{{ __('Upload') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<input type="hidden" id="updateLangItemRoute"
    value="{{ route('super_admin.setting.languages.update.translate', [$language->id]) }}">
<input type="hidden" id="language-translate-route"
    value="{{ route('super_admin.setting.languages.translate', [$language->id]) }}">
@endsection



@push('script')
<script src="{{asset('super_admin/js/languages.js')}}"></script>
@endpush