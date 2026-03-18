<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CurrencyRequest;
use App\Http\Services\CurrencyService;
use App\Models\Currency;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    use ResponseTrait;

    private $currencyService;

    public function __construct()
    {
        $this->currencyService = new CurrencyService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->currencyService->getAllData();
        }

        $data['title'] = __('Currency Setting');
        $data['showManageApplicationSetting'] = 'show';
        $data['activeCurrenciesSetting'] = 'active-color-one';
        // For the settings sub-sidebar (general-sidebar)
        $data['subCurrencySettingActiveClass'] = 'active-color-one';
        return view('super_admin.setting.currencies.index', $data);
    }

    public function edit($id)
    {
        $data['currency'] = Currency::findOrFail($id);
        return view('super_admin.setting.currencies.edit-form', $data);
    }


    public function store(CurrencyRequest $request)
    {
        return $this->currencyService->store($request);
    }

    public function update(CurrencyRequest $request, $id)
    {
        return $this->currencyService->update($request, $id);
    }

    public function delete($id)
    {
        return $this->currencyService->deleteById($id);
    }
}
