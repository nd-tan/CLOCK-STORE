<?php

namespace App\Repositories\Group;

use App\Models\Group;
use App\Repositories\BaseRepository;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{

    public function getModel()
    {
        return Group::class;
    }
    public function all($request)
    {
        $group = $this->model->all();
        // if (isset($request->name) && $request->name) {
        //     $name = $request->name;
        //     $Group->where('name', 'LIKE', '%' . $name . '%'  );
        // }
        return $group;
    }

    public function update($request, $group)
    {
        parent::update($request, $group);
        $group->roles()->detach();
        //attach cập nhập các record của bảng trung gian hiện tại
        $group->roles()->attach($request['roles']);
        return $group;
    }

    public function trashedItems()
    {

        $query = $this->model->onlyTrashed();

        $query->orderBy('id', 'desc');
        $group = $query->paginate(10);
        return $group;
    }

    public function restore($id)
    {

        $group = $this->model->withTrashed()->find($id);

        if ($group) {
            $group->restore();
            return true;
        } else {
            return false;
        }
        return $group;
    }

    public function force_destroy($id)
    {
        $group = $this->model->withTrashed()->find($id);
        if ($group) {
            $group->forceDelete();
            return $group;
        } else {
            return false;
        }
    }
}
