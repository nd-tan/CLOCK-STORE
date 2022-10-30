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
        $item = $this->groupService->find($id);
        return response()->json($item, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $user_groups
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatGroupRequest  $request
     * @param  \App\Models\Group  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        try {
            $item = $this->groupService->update($request->all(), $id);
            return redirect()->route('groups.index')->with('success', 'Cập nhật nhóm' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('error', 'Cập nhật nhóm' . ' ' . $request->name . ' ' .  'không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user_groups  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            $item = $this->groupService->delete($id);
            return redirect()->route('groups.index')->with('success', 'Xóa nhóm' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('error', 'Xóa nhóm' . ' ' . $request->name . ' ' .  'không thành công');
        }
    }

    // public function trashedItems()
    // {
    //     // dd($request);
    //     $items = $this->groupService->trashedItems();
    //     // dd($items);
    //     $params = [
    //         'items' => $items,
    //         // 'Group'=>$Group
    //     ];
    //     return view('admin.groups.trash',$params);
    // }

    public function restore($id)
    {
        try {
            $this->groupService->restore($id);
            return redirect()->route('groups.trash')->with('success', 'Khôi phục thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.trash')->with('success', 'Khôi phục thành công');
        }
    }

    public function force_destroy($id)
    {

        try {
            $Group = $this->groupService->force_destroy($id);
            return redirect()->route('groups.trash')->with('success', 'Xóa' . ' ' . $Group->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.trash')->with('error', 'Xóa' . ' ' . $Group->name . ' ' .  'không thành công');
        }
    }

}
