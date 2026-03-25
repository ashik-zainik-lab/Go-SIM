<?php

namespace App\Http\Services\SuperAdmin;

use App\Models\Country;
use App\Models\FileManager;
use App\Models\Region;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DestinationService
{
    use ResponseTrait;

    public function getRegionData()
    {
        $regions = Region::query()->orderBy('sort_order')->orderByDesc('id');

        return datatables($regions)
            ->addIndexColumn()
            ->addColumn('status_badge', function ($data) {
                $badgeClass = $data->status == STATUS_ACTIVE ? 'active' : 'inactive';
                $statusText = $data->status == STATUS_ACTIVE ? __('Active') : __('Inactive');

                return '<div class="dashboared-status-badge ' . $badgeClass . '">' . $statusText . '</div>';
            })
            ->addColumn('action', function ($data) {
                $editRoute = route('super_admin.destinations.regions.edit', $data->id);
                $deleteRoute = route('super_admin.destinations.regions.delete', $data->id);

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
            ->rawColumns(['status_badge', 'action'])
            ->make(true);
    }

    public function getCountryData($request)
    {
        $countries = Country::query()
            ->leftJoin('regions', 'countries.region_id', '=', 'regions.id')
            ->select(
                'countries.id',
                'countries.country_name',
                'countries.short_name',
                'countries.status',
                'regions.name as region_name'
            )
            ->orderByDesc('countries.id');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $countries->where(function ($q) use ($search) {
                $q->where('countries.country_name', 'like', "%{$search}%")
                    ->orWhere('countries.short_name', 'like', "%{$search}%")
                    ->orWhere('regions.name', 'like', "%{$search}%");
            });
        }

        return datatables($countries)
            ->addIndexColumn()
            ->editColumn('region_name', function ($data) {
                return $data->region_name ?? '-';
            })
            ->editColumn('status', function ($data) {
                $badgeClass = ((int)$data->status === STATUS_ACTIVE) ? 'active' : 'pending';
                $statusText = ((int)$data->status === STATUS_ACTIVE) ? __('Active') : __('Inactive');
                return '<div class="dashboared-status-badge ' . $badgeClass . '">' . $statusText . '</div>';
            })
            ->addColumn('action', function ($data) {
                $editRoute = route('super_admin.destinations.countries.edit', $data->id);
                $deleteRoute = route('super_admin.destinations.countries.delete', $data->id);

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
                                   onclick="deleteItem(\'' . $deleteRoute . '\', \'countryDataTable\')">
                                    <span>' . __("Delete") . '</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                ';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function storeRegion($request)
    {
        DB::beginTransaction();
        try {
            $iconFileId = null;
            if ($request->hasFile('icon')) {
                $newFile = new FileManager();
                $uploaded = $newFile->upload('regions', $request->icon);
                if (!is_null($uploaded)) {
                    $iconFileId = $uploaded->id;
                } else {
                    return $this->error([], getMessage(SOMETHING_WENT_WRONG));
                }
            }

            Region::create([
                'name' => $request->name,
                'code' => Str::upper($request->code),
                'icon' => $iconFileId,
                'description' => $request->description,
                'status' => $request->status ?? STATUS_ACTIVE,
            ]);

            DB::commit();
            return $this->success([], getMessage(CREATED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getErrorMessage($e, $e->getMessage()));
        }
    }

    public function updateRegion($request, $id)
    {
        DB::beginTransaction();
        try {
            $region = Region::findOrFail($id);
            $region->name = $request->name;
            $region->code = Str::upper($request->code);
            if ($request->hasFile('icon')) {
                $newFile = FileManager::where('id', $region->icon)->first();
                if ($newFile) {
                    $newFile->removeFile();
                    $uploaded = $newFile->upload('regions', $request->icon, '', $newFile->id);
                } else {
                    $newFile = new FileManager();
                    $uploaded = $newFile->upload('regions', $request->icon);
                }

                if (!is_null($uploaded)) {
                    $region->icon = $uploaded->id;
                } else {
                    return $this->error([], getMessage(SOMETHING_WENT_WRONG));
                }
            }
            $region->description = $request->description;
            $region->status = $request->status ?? $region->status;
            $region->save();

            DB::commit();
            return $this->success([], getMessage(UPDATED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getErrorMessage($e, $e->getMessage()));
        }
    }

    public function deleteRegion($id)
    {
        DB::beginTransaction();
        try {
            $region = Region::findOrFail($id);
            $region->delete();

            DB::commit();
            return $this->success([], getMessage(DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getErrorMessage($e, $e->getMessage()));
        }
    }

    public function storeCountry($request)
    {
        DB::beginTransaction();
        try {
            Country::create([
                'region_id' => $request->region_id,
                'country_name' => $request->country_name,
                'short_name' => strtoupper($request->short_name),
                'slug' => getSlug($request->country_name),
                'status' => $request->status ?? STATUS_ACTIVE,
                'continent' => $request->continent,
            ]);

            DB::commit();
            return $this->success([], getMessage(CREATED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getErrorMessage($e, $e->getMessage()));
        }
    }

    public function updateCountry($request, $id)
    {
        DB::beginTransaction();
        try {
            $country = Country::findOrFail($id);
            $country->region_id = $request->region_id;
            $country->country_name = $request->country_name;
            $country->short_name = strtoupper($request->short_name);
            $country->slug = getSlug($request->country_name);
            $country->status = $request->status ?? $country->status;

            if ($request->filled('continent')) {
                $country->continent = $request->continent;
            }

            $country->save();

            DB::commit();
            return $this->success([], getMessage(UPDATED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getErrorMessage($e, $e->getMessage()));
        }
    }

    public function deleteCountry($id)
    {
        DB::beginTransaction();
        try {
            $country = Country::findOrFail($id);
            $country->delete();

            DB::commit();
            return $this->success([], getMessage(DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error([], getErrorMessage($e, $e->getMessage()));
        }
    }
}