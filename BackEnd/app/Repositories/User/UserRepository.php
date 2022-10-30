<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use App\Models\Province;
use App\Models\Group;
use App\Models\District;
use App\Models\Ward;

use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use StorageImageTrait;

    public function getModel()
    {
        return User::class;
    }

    public function all($request)
    {

        $users = User::with('provinces','groups');
        // if (isset($request->name) && $request->name) {
        //     $name = $request->name;
        //     $user->where('name', 'LIKE', '%' . $name . '%');
        // }
        // if (isset($request->phone) && $request->phone) {
        //     $phone = $request->phone;
        //     $user->where('phone', 'LIKE', '%' . $phone . '%');
        // }
        // if (isset($request->address) && $request->address) {
        //     $address = $request->address;
        //     $user->where('address', 'LIKE', '%' . $address . '%');
        // }
        // if (isset($request->group_id) && $request->group_id) {
        //     $group_id = $request->user_group_id;
        //     $user->where('group_id', 'LIKE', '%' . $group_id . '%');
        // }
        // dd($user);
        // $user->orderBy('id', 'desc');
        // $users = $user->paginate(3);
        // dd($users);
        return $users->orderBy('id', 'DESC')->paginate(5);
    }

    public function delete($id)
    {
        $users = $this->model->find($id);
        try {
            $users->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $users;
    }

    public function create($data)
    {
        // dd($data->all());
        try {
            DB::beginTransaction();
            $object = $this->model;
            $object->name = $data->name;
            $object->phone = $data->phone;
            $object->password = Hash::make($data->password);
            $object->birthday = $data->birthday;
            $object->email = $data->email;
            $object->gender = $data->gender;
            $object->address = $data->address;
            $object->province_id = $data->province_id;
            $object->group_id = $data->group_id;
            $object->ward_id = $data->ward_id;
            $object->district_id = $data->district_id;
            $object->image = $data->image;
            // $dataUploadImage = $this->storageUpload($data, 'avatar', 'room');
            // $object->avatar = $dataUploadImage['file_path'];
            $object->save();
            DB::commit();
            Session::flash('success', 'Thêm nhân viên' . ' ' . $data->name . ' ' . 'thành công');
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
        return $object;
    }


    public function update($request, $id)
    {

        try {
            DB::beginTransaction();
            $object = $this->model->find($id);
            // dd(  $object);
            $object->name = $request->name;
            $object->phone = $request->phone;
            if ($request->password) {
                $object->password = Hash::make($request->password);
            }
            $object->birthday = $request->birthday;
            $object->email = $request->email;
            $object->gender = $request->gender;
            $object->address = $request->address;
            // $object->group_id = $request->group_id;
            // if ($request->avatar) {
            //     $dataUploadImage = $this->storageUpload($request, 'avatar', 'room');
            //     $object->avatar = $dataUploadImage['file_path'];
            // } else {
            //     $object->avatar = $object->avatar;
            // }

            // dd($object);
            $object->save();
            DB::commit();
            Session::flash('success', 'Chỉnh sửa nhân viên' . ' ' . $request->name . ' ' . 'thành công');
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }
        return $object;
    }

    public function getTrashed()
    {
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $user = $query->paginate(5);
        return $user;
    }

    public function restore($id)
    {
        $user = $this->model->withTrashed()->findOrFail($id);
        try {
            $user->restore();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $user;
    }

    public function force_destroy($id)
    {
        $user = $this->model->onlyTrashed()->findOrFail($id);
        try {
            $user->forceDelete();
            return $user;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $user;
        }
    }
    public function provinces()
    {
       return Province::orderBy('id', 'DESC')->get();

    }
    public function districts()
    {
       return District::orderBy('id', 'DESC')->get();

    }
    public function wards()
    {
       return Ward::orderBy('id', 'DESC')->get();

    }
}
