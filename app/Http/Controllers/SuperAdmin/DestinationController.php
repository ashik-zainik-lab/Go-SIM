<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Services\SuperAdmin\DestinationService;
use App\Models\Country;
use App\Models\Region;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    use ResponseTrait;

    private $destinationService;

    public function __construct()
    {
        $this->destinationService = new DestinationService;
    }

    public function index(Request $request)
    {
        if ($request->ajax() && $request->type === 'regions') {
            return $this->destinationService->getRegionData();
        }
        if ($request->ajax() && $request->type === 'countries') {
            return $this->destinationService->getCountryData($request);
        }

        $data['title'] = __('Destinations');
        $data['activeDestinationSetting'] = 'active-color-one';
        $data['activeDestinations'] = 'active';
        $data['regions'] = Region::query()->orderBy('sort_order')->orderBy('name')->get();
        $data['regionCards'] = Region::query()->orderBy('sort_order')->orderBy('name')->get();
        $data['regionOptions'] = region();
        $data['countryOptions'] = country();

        return view('super_admin.destinations.index', $data);
    }

    public function storeRegion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'required|string|max:50|unique:regions,code',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        return $this->destinationService->storeRegion($request);
    }

    public function editRegion($id)
    {
        $data['region'] = Region::findOrFail($id);
        $data['regionOptions'] = region();
        return view('super_admin.destinations.edit-region-form', $data);
    }

    public function updateRegion(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'required|string|max:50|unique:regions,code,' . $id,
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        return $this->destinationService->updateRegion($request, $id);
    }

    public function deleteRegion($id)
    {
        return $this->destinationService->deleteRegion($id);
    }

    public function storeCountry(Request $request)
    {
        $request->validate([
            'country_name' => 'required|string|max:191',
            'short_name' => 'required|string|max:10',
            'region_id' => 'nullable|integer',
            'continent' => 'nullable|string|max:191',
            'status' => 'nullable|integer',
        ]);

        return $this->destinationService->storeCountry($request);
    }

    public function editCountry($id)
    {
        $data['country'] = Country::findOrFail($id);
        $data['regions'] = Region::query()->orderBy('sort_order')->orderBy('name')->get();
        $data['countryOptions'] = country();

        return view('super_admin.destinations.edit-country-form', $data);
    }

    public function updateCountry(Request $request, $id)
    {
        $request->validate([
            'country_name' => 'required|string|max:191',
            'short_name' => 'required|string|max:10',
            'region_id' => 'nullable|integer',
            'continent' => 'nullable|string|max:191',
            'status' => 'nullable|integer',
        ]);

        return $this->destinationService->updateCountry($request, $id);
    }

    public function deleteCountry($id)
    {
        return $this->destinationService->deleteCountry($id);
    }
}