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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class );
        $users = $this->userService->all($request);

        // dd($users);
        // $groups = $this->groupService->all($request);
        // dd(Auth::user()->user_group_id);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = $this->userService->find($id);
        $groups = $this->groupService->all($id);

        $this->authorize('update', $users);
        return view('admin.users.edit', compact('groups', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
        // dd($request);
        $users = $this->userService->getTrashed();
        // dd($items);
        $params = [
            'users' => $users,
        ];
        return view('admin.users.recycle', $params);
    }

    public function restore($id)
    {
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
        try {
            $user = $this->userService->force_destroy($id);
            return redirect()->route('users.getTrashed')->with('success' . 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.getTrashed')->with('error', 'Xóa không thành công');
        }
    }
}
