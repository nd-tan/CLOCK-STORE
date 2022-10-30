<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Role;
use App\Models\Group;
use App\Services\Group\GroupServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $groupService;

    public function __construct(GroupServiceInterface $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny',Group::class);
        $items = $this->groupService->all($request);
        $params =[
            'items' => $items,
        ];
        return view('admin.groups.index',$params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Group::class);
        return view('admin.groups.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        try {
            $item = $this->groupService->create($request->all());
            return redirect()->route('groups.index')->with('success', 'Thêm nhóm' . ' ' . $item->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('error', 'Thêm nhóm' . ' ' . $item->name . ' ' .  'không thành công');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->authorize('view', Position::class);
        $item=Group::find($id);

        $current_user = Auth::user();
        $userRoles = $item->roles->pluck('id', 'name')->toArray();
        // dd($userRoles);
        $roles = Role::all()->toArray();
        $position_names = [];
        /////lấy tên nhóm quyền
        foreach ($roles as $role) {
            $position_names[$role['group_name']][] = $role;
        }
        $params = [
            'item' => $item,
            'userRoles' => $userRoles,
            'roles' => $roles,
            'position_names' => $position_names,
        ];
        return view('admin.groups.detail',$params);
    }

    public function edit($id)
    {
        $item = Group::find($id);
        $this->authorize('update',  $item);
        $current_user = Auth::user();
        $userRoles = $item->roles->pluck('id', 'name')->toArray();
        // dd($current_user->userGroup->roles->toArray());
        $roles = Role::all()->toArray();
        $group_names = [];
        foreach ($roles as $role) {
            $group_names[$role['group_name']][] = $role;
        }
        $params = [
            'item' => $item,
            'userRoles' => $userRoles,
            'roles' => $roles,
            'group_names' => $group_names,
        ];
        return view('admin.groups.edit',$params);
    }

    public function update( $id,Request $request)
    {
        try {
            $item = $this->groupService->update( $id, $request->roles);
            Session::flash('success', config('define.update.succes'));
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', config('define.update.error'));
            return redirect()->route('groups.index');
        }
    }

    public function destroy(Request $request,$id)
    {
        try {
            $item = $this->groupService->delete($id);
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', config('define.restore.error'));
            return redirect()->route('groups.index');
        }
    }

    public function getTrashed()
    {
        $items = $this->groupService->trashedItems();
        $params = [
            'items' => $items,
        ];
        return view('admin.Groups.recycle',$params);
    }

    public function restore($id)
    {
        try {
            $this->groupService->restore($id);
            Session::flash('success', config('define.restore.succes'));
            return redirect()->route('group.getTrashed');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', config('define.restore.error'));
            return redirect()->route('group.getTrashed');
        }
    }

    public function force_destroy($id)
    {

        try {
            $Group = $this->groupService->force_destroy($id);
            Session::flash('success', config('define.delete.succes'));
            return redirect()->route('group.getTrashed');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', config('define.delete.error'));
            return redirect()->route('group.getTrashed');
        }
    }

}
