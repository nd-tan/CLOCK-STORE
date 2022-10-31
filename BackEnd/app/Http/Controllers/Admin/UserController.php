<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Group\GroupServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;
    protected $groupService;

    public function __construct(UserServiceInterface $userService, GroupServiceInterface $groupService)
    {
        $this->userService = $userService;
        $this->groupService = $groupService;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $this->authorize('viewAny', User::class );
        $users = $this->userService->all($request);
        return view('admin.users.index', compact('users'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', User::class );
        $groups = $this->groupService->all($request);
        $provinces = $this->userService->provinces();
        $districts = $this->userService->districts();
        $wards = $this->userService->wards();
        return view('admin.users.add', compact('groups','provinces','districts','wards'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->create($request);
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('update', User::class);
        $users = $this->userService->find($id);
        $groups = $this->groupService->all($id);
        return view('admin.users.edit', compact('groups', 'users'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->userService->update($request, $id);
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index');
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        try {
            $this->userService->delete($id);
            return redirect()->route('users.index')->with('success', ' Xóa  phòng thành công ');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('error', 'Xóa  phòng không thành công');
        }
    }

    public function getTrashed()
    {
        $users = $this->userService->getTrashed();
        $params = [
            'users' => $users,
        ];
        return view('admin.users.recycle', $params);
    }

    public function restore($id)
    {
        $this->authorize('restore', User::class);
        try {
            $this->userService->restore($id);
            return redirect()->route('users.getTrashed')->with('success', 'Khôi phục thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.getTrashed')->with('success', 'Khôi phục thành công');
        }
    }

    public function force_destroy($id)
    {
        $this->authorize('forceDelete', User::class);
        try {
            $user = $this->userService->force_destroy($id);
            return redirect()->route('users.getTrashed')->with('success' . 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.getTrashed')->with('error', 'Xóa không thành công');
        }
    }
}
