<?php

namespace App\Services\Api\Brand;

use App\Repositories\api\Brand\ApiBrandRepositoryInterface;
use App\Services\Api\Brand\BrandApiServiceInterface;
use App\Services\BaseService;

class BrandApiService extends BaseService implements ApiBrandServiceInterface {

    public $repository;
    public function __construct(ApiBrandRepositoryInterface $brandRepository)
    {
        $this->repository = $brandRepository;
    }
    public function getTrash()
    {
        return $this->repository->getTrash();
    }
    public function restore($id)
    {
        return $this->repository->restore($id);
    }
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }
    public function searchBrand($name)
    {
        return $this->repository->searchBrand($name);
    }
}
