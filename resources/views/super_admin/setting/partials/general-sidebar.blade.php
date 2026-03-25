<div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
    <a class="nav-link {{ !empty($subApplicationSettingActiveClass) ? 'active' : '' }} {{ $subApplicationSettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.application-settings') }}">
        {{ __('General Settings') }}
    </a>

    <a class="nav-link {{ !empty($subLogoSettingActiveClass) ? 'active' : '' }} {{ $subLogoSettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.logo-settings') }}">
        {{ __('Logo Settings') }}
    </a>

    <a class="nav-link {{ !empty($subColorSettingActiveClass) ? 'active' : '' }} {{ $subColorSettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.color-settings') }}">
        {{ __('Color Settings') }}
    </a>

    <a class="nav-link {{ !empty($subStorageSettingActiveClass) ? 'active' : '' }} {{ $subStorageSettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.storage.index') }}">
        {{ __('Storage Settings') }}
    </a>

    <a class="nav-link {{ !empty($subMaintenanceModeActiveClass) ? 'active' : '' }} {{ $subMaintenanceModeActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.maintenance') }}">
        {{ __('Maintenance Mode') }}
    </a>

    <a class="nav-link {{ !empty($subLanguageSettingActiveClass) ? 'active' : '' }} {{ $subLanguageSettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.languages.index') }}">
        {{ __('Language Settings') }}
    </a>

    <a class="nav-link {{ !empty($subCurrencySettingActiveClass) ? 'active' : '' }} {{ $subCurrencySettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.currencies.index') }}">
        {{ __('Currency Settings') }}
    </a>

    <a class="nav-link {{ !empty($subCacheActiveClass) ? 'active' : '' }} {{ $subCacheActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.cache-settings') }}">
        {{ __('Cache Settings') }}
    </a>

    <a class="nav-link {{ !empty($subGatewaySettingActiveClass) ? 'active' : '' }} {{ $subGatewaySettingActiveClass ?? '' }}"
        href="{{ route('super_admin.setting.gateway.index') }}">
        {{ __('Gateway Settings') }}
    </a>
</div>