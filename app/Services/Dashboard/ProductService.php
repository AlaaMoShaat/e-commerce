<?php

namespace App\Services\Dashboard;

use PgSql\Lob;
use App\Utils\ImageManeger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\ProductRepository;

class ProductService
{
    protected $productRepository, $imageManager;
    public function __construct(ProductRepository $productRepository, ImageManeger $imageManager)
    {
        $this->productRepository = $productRepository;
        $this->imageManager = $imageManager;
    }

    public function getProduct($id) {
        $product = $this->productRepository->getProduct($id);
        return $product?? abort(404);
    }

    public function getProductWithEgarLoading($id) {
        $product = $this->productRepository->getProductWithEgarLoading($id);
        return $product?? abort(404);
    }

    public function getProductsForDataTable() {
        $products = $this->productRepository->getAllProducts();
        return DataTables::of($products)->addIndexColumn()
        ->addColumn('name', function ($product) {
            return $product->getTranslation('name', app()->getLocale());
        })
        ->addColumn('has_variants', function ($product) {
            return $product->hasVariantsTranslated();
        })
        ->addColumn('images', function ($product) {
            return view('dashboard.products.products.datatables.images', compact('product'));
        })
        ->addColumn('category', function($product) {
            return $product->category->name;
        })
        ->addColumn('brand', function($product) {
            return $product->brand->name;
        })
        ->addColumn('status', function($product) {
            return view('dashboard.products.products.datatables.statusFeild', compact('product'));
        })
        ->addColumn('actions', function ($product) {
            return view('dashboard.products.products.datatables.actions', compact('product'));
        })
        ->make(true);
    }

    public function createProductWithDetails($product, $productVariants, $productImages) {

        try {
            DB::beginTransaction();

            $product = $this->productRepository->createProduct($product);
            if (!$product) {
                return false;
            }

            foreach ($productVariants as $variant) {
                $variant['product_id'] = $product->id;
                $productVariant = $this->productRepository->createProductVariant($variant);
                if(!$productVariant) {
                    return false;
                }
                foreach ($variant['attribute_value_ids'] as $attribute_value_id) {
                    $variantAttributes = $this->productRepository->createVariantAttribute([
                        'product_variant_id' => $productVariant->id,
                        'attribute_value_id' => $attribute_value_id,
                    ]);
                    if(!$variantAttributes) {
                        return false;
                    }
                }

            }

            $this->imageManager->uploadImages($productImages, $product, 'products');
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Create Product Errors', $e->getMessage());
            return false;
        }
    }

    public function updateProductWithDetails($product, $productData, $productVariants, $productImages)
    {

        try {
            DB::beginTransaction();
            $product = $this->productRepository->updateProduct($product, $productData);
            if(!$product) {
                return false;
            }
            // delete old variants
            $this->productRepository->deleteProductVariants($product);

            foreach ($productVariants as $variant) {
                $productVariant = $this->productRepository->createProductVariant($variant);
                if(!$productVariant) {
                    return false;
                }
                foreach ($variant['attribute_value_ids'] as $attribute_value_id) {
                    $variantAttributes = $this->productRepository->createVariantAttribute([
                        'product_variant_id' => $productVariant->id,
                        'attribute_value_id' => $attribute_value_id,
                    ]);
                    if(!$variantAttributes) {
                        return false;
                    }
                }

            }
            $this->imageManager->uploadImages($productImages, $product, 'products');
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Product Errors', $e->getMessage());
            return false;
        }
    }

    public function deleteProduct($id) {
        $product = self::getProduct($id);
        $this->productRepository->deleteProduct($product);
        return $product?? false;
    }

    public function changeStatus($id) {
        $product = self::getProduct($id);
        $product = $this->productRepository->changeStatus($product);
        return $product?? false;
    }

    public function deleteVariant($id) {
        $variant = $this->productRepository->deleteVariant($id);
        return $variant?? false;
    }

    public function deleteProductImage($imageId, $file_name) {
        $this->imageManager->deleteImageFromLocal('uploads/products/'.$file_name);
        return $this->productRepository->deleteProductImage($imageId);
    }
}