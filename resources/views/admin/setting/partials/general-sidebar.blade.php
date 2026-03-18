<div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
    <a class="nav-link {{ !empty($subApplicationSettingActiveClass) ? 'active' : '' }} {{ $subApplicationSettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.application-settings') }}">
        {{ __('General Settings') }}
    </a>

    <a class="nav-link {{ !empty($subLogoSettingActiveClass) ? 'active' : '' }} {{ $subLogoSettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.logo-settings') }}">
        {{ __('Logo Settings') }}
    </a>

    <a class="nav-link {{ !empty($subColorSettingActiveClass) ? 'active' : '' }} {{ $subColorSettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.color-settings') }}">
        {{ __('Color Settings') }}
    </a>

    <a class="nav-link {{ !empty($subStorageSettingActiveClass) ? 'active' : '' }} {{ $subStorageSettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.storage.index') }}">
        {{ __('Storage Settings') }}
    </a>

    <a class="nav-link {{ !empty($subMaintenanceModeActiveClass) ? 'active' : '' }} {{ $subMaintenanceModeActiveClass ?? '' }}"
       href="{{ route('admin.setting.maintenance') }}">
        {{ __('Maintenance Mode') }}
    </a>

    <a class="nav-link {{ !empty($subCacheActiveClass) ? 'active' : '' }} {{ $subCacheActiveClass ?? '' }}"
       href="{{ route('admin.setting.cache-settings') }}">
        {{ __('Cache Settings') }}
    </a>

    <a class="nav-link {{ !empty($subGatewaySettingActiveClass) ? 'active' : '' }} {{ $subGatewaySettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.gateway.index') }}">
        {{ __('Gateway Settings') }}
    </a>

    <a class="nav-link {{ !empty($subLanguageSettingActiveClass) ? 'active' : '' }} {{ $subLanguageSettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.languages.index') }}">
        {{ __('Language Settings') }}
    </a>

    <a class="nav-link {{ !empty($subCurrencySettingActiveClass) ? 'active' : '' }} {{ $subCurrencySettingActiveClass ?? '' }}"
       href="{{ route('admin.setting.currencies.index') }}">
        {{ __('Currency Settings') }}
    </a>
</div>
