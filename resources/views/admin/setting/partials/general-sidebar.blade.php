<div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
    <a class="nav-link {{ @$subApplicationSettingActiveClass }}"
       href="{{ route('admin.setting.application-settings') }}">
        {{ __('App Settings') }}
    </a>

    <a class="nav-link {{ @$subLogoSettingActiveClass }}"
       href="{{ route('admin.setting.logo-settings') }}">
        {{ __('Logo Settings') }}
    </a>

    <a class="nav-link {{ @$subColorSettingActiveClass }}"
       href="{{ route('admin.setting.color-settings') }}">
        {{ __('Color Settings') }}
    </a>

    <a class="nav-link {{ @$subStorageSettingActiveClass }}"
       href="{{ route('admin.setting.storage.index') }}">
        {{ __('Storage Settings') }}
    </a>

    <a class="nav-link {{ @$subMaintenanceModeActiveClass }}"
       href="{{ route('admin.setting.maintenance') }}">
        {{ __('Maintenance Mode') }}
    </a>

    <a class="nav-link {{ @$subCacheActiveClass }}"
       href="{{ route('admin.setting.cache-settings') }}">
        {{ __('Cache Settings') }}
    </a>

    <a class="nav-link {{ @$subGatewaySettingActiveClass }}"
       href="{{ route('admin.setting.gateway.index') }}">
        {{ __('Gateway Settings') }}
    </a>

    <a class="nav-link {{ @$subLanguageSettingActiveClass }}"
       href="{{ route('admin.setting.languages.index') }}">
        {{ __('Language Settings') }}
    </a>

    <a class="nav-link {{ @$subCurrencySettingActiveClass }}"
       href="{{ route('admin.setting.currencies.index') }}">
        {{ __('Currency Settings') }}
    </a>
</div>
