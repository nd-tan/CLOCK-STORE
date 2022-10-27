<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Specifications;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function all($request)
    {
        $products = $this->model->select('*');
        if (!empty($request->search)) {
            $search = $request->search;
            $products = $products->search($search);
        }
        return $products->orderBy('id', 'DESC')->paginate(5);
    }
    public function create($data)
    {
        // dd($data);

        try {
            $product = $this->model;
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->description = $data['description'];
            $product->supplier_id = $data['supplier_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            // $product->created_by = Auth::user()->id;
            if ($data['inputFile']) {
                $file = $data['inputFile'];
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = time(); // create file name by curent time
                $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
                $data['inputFile']->storeAs('public/images/product', $newFileName); //save file in public/images/brand with newname is newFileName
                $data['image'] = $newFileName;
                $product->image = $data['image'];
            }
            // dd($data);
            $product->save();
            // dd(123);

            //create product_images
            if ($data['file_names']) {
            // dd(456);

                foreach ($data['file_names'] as $key => $file_detail) {
                    $fileExtension = $file_detail->getClientOriginalExtension();
                    $newFileName =  $key . '.' . $fileExtension;
                    $file_detail->storeAs('public/images/product', $newFileName);
                    // $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->product_images()->saveMany([
                        new ProductImage([
                            'image' => $newFileName,
                        ]),
                    ]);
                }
            }
            return $product;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }

    public function update($id, $data)
    {

        try {
            //create product
            $product = $this->model->find($id);
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->sale_price = $data['sale_price'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->description = $data['description'];
            $product->created_by = Auth::user()->id;
            if (!empty($data['image'])) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $product->image = $path;
            }
            $product->save();


            //create product_images
            if ($data['file_names']) {
                ProductImage::where('product_id', '=', $product->id)->delete();
                foreach ($data['file_names'] as $file_detail) {
                    // File::delete($product->file_names()->file_name);
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->file_names()->saveMany([
                        new ProductImage([
                            'product_id' => $product->id,
                            'file_name' => $detail_path,
                        ]),
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function delete($id)
    {
        $product = $this->model->find($id);
        try {
            $product->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function getTrashed()
    {
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $product = $query->paginate(5);
        return $product;
    }
    public function restore($id)
    {
        $product = $this->model->withTrashed()->findOrFail($id);
        $product->restore();
        return $product;
    }
    public function force_destroy($id)
    {
        $product = $this->model->onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return $product;
    }
}
