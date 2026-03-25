<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\EditUserRequest;
use App\Http\Requests\SuperAdmin\UserRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use App\Traits\General;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    use General;
    use ResponseTrait;

    public function index(Request $request)
    {
        if ($request->ajax() && $request->type === 'admins') {
            $users = User::query()
                ->where('role', USER_ROLE_ADMIN)
                ->select('id', 'name', 'email', 'mobile', 'status')
                ->orderByDesc('id');

            if ($request->filled('search')) {
                $search = trim($request->search);
                $users->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%");
                });
            }

            return datatables($users)
                ->addIndexColumn()
                ->editColumn('role', function ($u) {
                    return (int)$u->role === USER_ROLE_ADMIN ? __('Admin') : __('User');
                })
                ->editColumn('status', function ($u) {
                    $badgeClass = ((int)$u->status === USER_STATUS_ACTIVE) ? 'active' : 'pending';
                    $statusText = ((int)$u->status === USER_STATUS_ACTIVE) ? __('Active') : __('Inactive');
                    return '<div class="dashboared-status-badge ' . $badgeClass . '">' . $statusText . '</div>';
                })
                ->addColumn('action', function ($u) {
                    $editRoute = route('super_admin.users.edit', $u->id);
                    $deleteRoute = route('super_admin.users.delete', $u->id);

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
                                       onclick="deleteItem(\'' . $deleteRoute . '\', \'userDataTable\')">
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

        $data['title'] = 'Admin Users';
        $data['navUserParentActiveClass'] = 'mm-active';
        $data['navUserParentShowClass'] = 'mm-show';
        $data['subNavUserActiveClass'] = 'mm-active';

        return view('super_admin.user.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Add User';
        $data['navUserParentActiveClass'] = 'mm-active';
        $data['navUserParentShowClass'] = 'mm-show';
        $data['subNavUserCreateActiveClass'] = 'mm-active';
        $data['roles'] = Role::all();
        return view('super_admin.user.create', $data);
    }


    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now()->format("Y-m-d H:i:s");
        $user->save();
        return $this->controlRedirection($request, 'user', 'User');

    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('super_admin.user.edit-form', $data);
    }

    public function update(EditUserRequest $request, $id)
    {
        if (User::whereEmail($request->email)->where('id', '!=', $id)->count() > 0)
        {
            $this->showToastrMessage('warning', 'Email already exist');
            if ($request->ajax() || $request->wantsJson()) {
                return $this->error([], 'Email already exist');
            }
            return redirect()->back();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        $user->save();
        if ($request->ajax() || $request->wantsJson()) {
            return $this->success([], getMessage(UPDATED_SUCCESSFULLY));
        }

        return $this->controlRedirection($request, 'user', 'User');

    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                User::whereId($id)->where('role', USER_ROLE_ADMIN)->delete();
                return response()->json([
                    'message' => 'User has been deleted',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }
        }

        User::whereId($id)->where('role', USER_ROLE_ADMIN)->delete();

        $this->showToastrMessage('error', 'User has been deleted');
        return redirect()->back();
    }

}