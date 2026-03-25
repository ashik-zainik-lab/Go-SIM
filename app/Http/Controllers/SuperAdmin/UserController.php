<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\EditUserRequest;
use App\Http\Requests\SuperAdmin\UserRequest;
use App\Models\User;
use App\Traits\General;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    use General;

    public function index(Request $request)
    {
        if ($request->ajax() && $request->type === 'admins') {
            $users = User::query()
                ->where('role', USER_ROLE_ADMIN)
                ->select('id', 'name', 'email', 'mobile', 'status', 'role')
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
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 1;
        $user->assignRole($request->role_name);
        $user->email_verified_at = Carbon::now()->format("Y-m-d H:i:s");
        $user->save();
        return $this->controlRedirection($request, 'user', 'User');

    }

    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['navUserParentActiveClass'] = 'mm-active';
        $data['navUserParentShowClass'] = 'mm-show';
        $data['subNavUserActiveClass'] = 'mm-active';
        $data['roles'] = Role::all();
        $data['user'] = User::find($id);
        return view('super_admin.user.edit', $data);
    }

    public function update(EditUserRequest $request, $id)
    {
        if (User::whereEmail($request->email)->where('id', '!=', $id)->count() > 0)
        {
            $this->showToastrMessage('warning', 'Email already exist');
            return redirect()->back();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        if ($request->role_name)
        {
            DB::table('model_has_roles')->where('role_id', $user->roles->first()->id)->where('model_id', $id)->delete();
        }
        $user->assignRole($request->role_name);
        $user->save();
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
