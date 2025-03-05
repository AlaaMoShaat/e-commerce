<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;

class ProductRepository
{

    public function getProduct($id) {
        return Product::find($id);
    }

    public function getProductWithEgarLoading($id) {
        return Product::with('variants.variantAttributes')->find($id);
    }

    public function getAllProducts() {
        return Product::with('variants')->latest()->get();
    }

   public function createProduct($data) {
        return Product::create($data);
   }

   public function createProductVariant($data) {
        return ProductVariant::create($data);
   }

   public function createVariantAttribute($data) {
     return VariantAttribute::create($data);
   }

   public function updateProduct($product, $productData) {
     $product->update($productData);
     return $product;
   }

   public function deleteProduct($product) {
        return $product->delete();
   }

   public function deleteProductVariants($product) {
     return $product->variants()->delete();

   }
     public function changeStatus($product) {
    $product = $product->update([
        'status' => $product->status == '1'? '0' : '1',
     ]);
     return $product;
   }

   public function deleteVariant($id) {
     return ProductVariant::destroy($id);
   }

   public function deleteProductImage($imageId) {
     return ProductImage::destroy($imageId);
   }
}