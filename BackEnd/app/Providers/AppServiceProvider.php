<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Supplier\SupplierService;
use App\Services\Supplier\SupplierServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Services\Customer\CustomerService;
use App\Services\Customer\CustomerServiceInterface;
class AppServiceProvider extends ServiceProvider
{
    const succes = 'Thêm thành công';
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->singleton(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(SupplierServiceInterface::class, SupplierService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    Paginator::useBootstrapFive();
    Paginator::useBootstrapFour();
    }
}
