<?php

namespace App\Http\Services;

use App\Models\Currency;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;

class CurrencyService
{
    use ResponseTrait;

    public function getAllData()
    {
        $currencies = Currency::orderBy('id', 'desc')
            ->select('id', 'currency_code', 'current_currency', 'symbol', 'currency_placement');

    
        return datatables($currencies)
            ->addIndexColumn()
            ->editColumn('currency_code', function ($data) {
                $currencyCode = $data->currency_code;
                if ($data->current_currency == STATUS_ACTIVE) {
                    $currencyCode = $currencyCode . ' <b>(Current Currency)';
                }
                return $currencyCode;
            })
            ->addColumn('action', function ($data){
                $editRoute = route('admin.setting.currencies.edit', $data->id);
                $deleteRoute = route('admin.setting.currencies.delete', $data->id);

                return '
                    <div class="language-edit d-flex align-items-center text-nowrap">
                        <button class="dashboard-menu-dots" data-bs-toggle="dropdown"
                                aria-expanded="false" type="button">
                            <img src="' . asset('assets/images/icons/dots.svg') . '" alt="dots">
                        </button>
                        <ul class="dropdown-menu dashboared-table-dropdown dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)"
                                   onclick="getEditModal(\'' . $editRoute . '\', \'#edit-modal\')">
                                    <span>' . __("Edit") . '</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)"
                                   onclick="deleteItem(\'' . $deleteRoute . '\', \'commonDataTable\')">
                                    <span>' . __("Delete") . '</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                ';

            })
            ->rawColumns(['action', 'currency_code'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $currency = new Currency();
            $currency->currency_code = $request->currency_code;
            $currency->symbol = $request->symbol;
            $currency->currency_placement = $request->currency_placement;
            $currency->save();

            if ($request->current_currency) {
                Currency::where('id', $currency->id)->update(['current_currency' => STATUS_ACTIVE]);
                Currency::where('id', '!=', $currency->id)->update(['current_currency' => STATUS_PENDING]);
            }

            DB::commit();

            $message = getMessage(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $currency = Currency::findOrFail($id);
            $currency->currency_code = $request->currency_code;
            $currency->symbol = $request->symbol;
            $currency->currency_placement = $request->currency_placement;
            $currency->save();
            if ($request->current_currency) {
                Currency::where('id', $currency->id)->update(['current_currency' => STATUS_ACTIVE]);
                Currency::where('id', '!=', $currency->id)->update(['current_currency' => STATUS_PENDING]);
            }

            DB::commit();

            $message = getMessage(UPDATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }

    public function getById($id)
    {
        return Currency::findOrFail($id);
    }

    public function deleteById($id)
    {

        try {
            DB::beginTransaction();
            $currency = Currency::findOrFail($id);
            $currency->delete();
            DB::commit();
            $message = getMessage(DELETED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([], $message);
        }
    }
}