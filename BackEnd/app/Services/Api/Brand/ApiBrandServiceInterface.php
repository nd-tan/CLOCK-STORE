<?php
namespace App\Services\Api\Brand;

use App\Services\ServiceInterface;

interface ApiBrandServiceInterface extends ServiceInterface
{
    public function getTrash();
    public function restore($id);
    public function forceDelete($id);
    public function searchBrand($name);


}
