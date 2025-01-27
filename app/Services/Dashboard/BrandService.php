<?php

namespace App\Services\Dashboard;

use App\Utils\ImageManeger;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\BrandRepository;

class BrandService
{
    /**
     * Create a new class instance.
     */
    protected $brandRepository, $imageManeger;
    public function __construct(BrandRepository $brandRepository, ImageManeger $imageManeger)
    {
        $this->imageManeger = $imageManeger;
        $this->brandRepository = $brandRepository;
    }

    public function getBrandsForDataTable() {
        $brands = $this->brandRepository->getBrands();
        return DataTables::of($brands)->addIndexColumn()
        ->addColumn('status', function($brand) {
            return '<p id="status_' . $brand->id . '"
                style="align-items: center; border-radius: 6px; text-align: center;"
                class="' . ($brand->status == 1 ? 'btn-success' : 'btn-danger') . '">
                ' . $brand->getStatusTranslatable() . '
             </p>';

        })->addColumn('name', function($brand) {
            return $brand->getTranslation('name', app()->getLocale());
        })->addColumn('logo', function($brand) {
            return '<img src="'.asset($brand->logo).'" width="50px" height="50px"/>';
        })->addColumn('products_count', function($brand) {
            return $brand->products_count == 0 ? __('static.global.no_items') : $brand->products_count;
        })->addColumn('actions', function ($brand) {
            return view('dashboard.brands.datatables.actions', compact('brand'));
        })->rawColumns(['actions', 'logo', 'status'])->make(true);
    }

    public function getBrand($id) {
        $brand = $this->brandRepository->getBrand($id);
        if (!$brand) {
            abort(404);
        }
        return $brand;
    }

    public function createBrand($data) {
        if(!empty($data['logo'])) {
            $file_name = $this->imageManeger->uploadSingleImage('/', $data['logo'], 'brands');
            $data['logo'] = $file_name; //update logo value
        }
        $brand = $this->brandRepository->createBrand($data);
        if (!$brand) {
            return false;
        }
        self::brandCache();
        return $brand;
    }

    public function updateBrand($data, $id) {
        $brand = $this->getBrand($id);

        if(!empty($data['logo'])) {
            if($brand->logo != null) {
                $this->imageManeger->deleteImageFromLocal($brand->logo);
            }
            $file_name = $this->imageManeger->uploadSingleImage('/', $data['logo'], 'brands');
            $data['logo'] = $file_name; //update logo value
        }
        $brand = $this->brandRepository->updateBrand($data, $brand);
        if (!$brand) {
            return false;
        }
        return $brand;
    }

    public function deleteBrand($id) {
        $brand = $this->getBrand($id);
        if($brand->logo != null) {
            $this->imageManeger->deleteImageFromLocal($brand->logo);
        }
        $brand = $this->brandRepository->deleteBrand($brand);
        self::brandCache();
        return $brand;
    }

    public function changeStatus($id) {
        $brand = $this->getBrand($id);
        if (!$brand) {
            abort(404);
        }
        $brand = $this->brandRepository->changeStatus($brand);
        if (!$brand) {
            return false;
        }
        self::brandCache();
        return $brand;
    }


    public function brandCache() {
        Cache::forget('brands_count');
    }
}