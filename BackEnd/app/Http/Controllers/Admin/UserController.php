<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\District;
use App\Models\Ward;
use App\Models\User;

use App\Services\Group\GroupServiceInterface;
use App\Services\User\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
        $this->authorize('viewAny', User::class);
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
        $this->authorize('create', User::class);
        $groups = $this->groupService->all($request);
        $provinces = $this->userService->provinces();
        // $districts = $this->userService->districts();
        // $wards = $this->userService->wards();
        return view('admin.users.add', compact('groups', 'provinces'));
    }
    public function GetDistricts(Request $request)
    {
        $province_id = $request->province_id;
        $allDistricts = District::where('province_id', $province_id)->get();
        return response()->json($allDistricts);
    }
    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $allWards = Ward::where('district_id', $district_id)->get();
        return response()->json($allWards);
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
            DB::beginTransaction();
            $this->userService->create($request);
            Session::flash('success', config('define.store.succes'));
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.store.error'));
            return redirect()->route('users.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        } else {
            return view('admin.users.login');
        }
    }
    public function show($id)
    {
        $user = $this->userService->find($id);
        return view('admin.users.detail', compact('user'));
    }

    public function edit($id)
    {
        $users = $this->userService->find($id);
        $groups = $this->groupService->all($id);
        $provinces = $this->userService->provinces();
        $districts = $this->userService->districts();
        $wards = $this->userService->wards();
        $this->authorize('update', $users);
        return view('admin.users.edit', compact('groups', 'users', 'provinces', 'districts', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $this->userService->update($id, $data);
            Session::flash('success', config('define.update.succes'));
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.update.error'));
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
            DB::beginTransaction();
            $this->userService->delete($id);
            Session::flash('success', config('define.recycle.succes'));
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.recycle.error'));
            return redirect()->route('users.index');
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
            DB::beginTransaction();
            $this->userService->restore($id);
            Session::flash('success', config('define.restore.succes'));
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.restore.error'));
            return redirect()->route('users.index');
        }
    }

    public function force_destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->userService->force_destroy($id);
            Session::flash('success', config('define.delete.succes'));
            DB::commit();
            return redirect()->route('user.getTrashed');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.delete.error'));
            return redirect()->route('user.getTrashed');
        }
    }
    // public function showStatus($id){

    //     $user = User::findOrFail($id);
    //     $user->status = '1';
    //     if ($user->save()) {
    //         return redirect()->back();
    //     }
    // }
    // public function hideStatus($id){

    //     $user = User::findOrFail($id);
    //     $user->status = '0';
    //     if ($user->save()) {
    //         return redirect()->back();
    //     }

}
