<?php

namespace App\Services\Api\Product;

use App\Services\Api\BaseService;
use App\Repositories\Api\Product\ApiProductRepositoryInterface;

class FeProductService extends BaseService implements ApiProductServiceInterface {

    public $repository;
    public function __construct(ApiProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function search($request)
    {
        return $this->repository->search($request);
    }
    public function find($id)
    {
        return $this->repository->find($id);
    }
    public function trendingProduct()
    {
        return $this->repository->trendingProduct();
    }
}
