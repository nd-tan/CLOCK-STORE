<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        return view('#',compact('categories'));
    }

    public function create()
    {
        return view('#');
    }
    
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryService->create($data);
        $notification = array(
            'message' => 'Thêm danh mục thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('#')->with($notification);
    }

    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        return view('#',compact('category'));
    }

    public function update(UpdateCategoryRequest $request,$id)
    {
        $data = $request->all();
        $this->categoryService->update( $id, $data);
        $notification = array(
            'message' => 'Sửa danh mục thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('#')->with($notification);

    }

    public function destroy($id)
    {
        $category = $this->categoryService->delete( $id);
        return response()->json($category);
    }

    public function getTrashed(){
        $categories = $this->categoryService->getTrashed();
        return view('#',compact('categories'));
    }

    public function restore($id){
        $this->categoryService->restore($id);
        $notification = array(
            'message' => 'Khôi phục danh mục thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('')->with($notification);
    }

    public function force_destroy($id){
        try {
            $category = $this->categoryService->force_destroy( $id);
            return response()->json($category);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Không thể xóa vì có sản phẩm thuộc danh mục này!',
                'alert-type' => 'error'
            );
            return redirect()->route('')->with($notification);
        }
    }
}
