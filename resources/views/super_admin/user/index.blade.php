@extends('super_admin.layouts.app')

@push('title')
{{ $title }}
@endpush

@section('content')
<div class="p-30">
    <input type="hidden" id="user-route" value="{{ route('super_admin.users.index') }}">

    <div class="dashboard-section-title">
        <h2 class="title">{{ __('Admin Users') }}</h2>
        <p>{{ __('Manage admin users in your system.') }}</p>
    </div>

    <div class="dashboard_search_addNew_box">
        <div class="serach_field_area">
            <form action="#" id="userSearchForm">
                <div class="search_field">
                    <img class="search-image" src="{{ asset('assets/images/icons/search.svg') }}"
                        alt="search icon">
                    <input type="text" placeholder="{{ __('Search Users...') }}" id="userSearchInput"
                        name="search">
                </div>
            </form>
        </div>
    </div>

    <div class="dashboard_common_table table-responsive">
        <table class="table zTable" id="userDataTable">
            <thead class="table-heading">
                <tr>
                    <th>{{ __('SL#') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Mobile') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('super_admin/js/users.js') }}"></script>
@endpush

