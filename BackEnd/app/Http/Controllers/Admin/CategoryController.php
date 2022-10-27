<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->all($request);
        return view('admin.category.index',compact('categories'));
    }
    public function show($id){

    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        try {
            $this->categoryService->create($data);
            Session::flash('success', 'Tạo mới thành công!');
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Tạo mới không thành công!');
            Log::error('message:'. $e->getMessage());
            return redirect()->route('category.index');
        }
    }

    public function edit($id)
    {
        $item = $this->categoryService->find($id);
        return view('admin.category.edit',compact('item'));
    }

    public function update(UpdateCategoryRequest $request,$id)
    {
        $data = $request->all();
        try {
            Session::flash('success', 'Sửa thành công!');
            $this->categoryService->update( $id, $data);
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Sửa không thành công!');
            return redirect()->route('category.index');
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->categoryService->delete($id);
            Session::flash('success', 'Đưa vào thùng rác thành công!');
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Đưa vào thùng rác không thành công!');
            return redirect()->route('category.index');
        }
    }

    public function getTrashed(){
        $categories = $this->categoryService->getTrashed();
        return view('admin.category.recycle',compact('categories'));
    }

    public function restore($id){
        try {
            $this->categoryService->restore($id);
            Session::flash('success', 'Khôi phục thành công!');
            return redirect()->route('category.getTrashed');
        } catch (\Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Khôi phục không thành công!');
            return redirect()->route('category.getTrashed');
        }
    }

    public function force_destroy($id){
        try {
            $category = $this->categoryService->force_destroy( $id);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->route('category.getTrashed');
        } catch (Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Xóa không thành công!');
            return redirect()->route('category.getTrashed');
        }
    }
}
