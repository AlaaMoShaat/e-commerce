<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use App\Services\Dashboard\ProductService;

class EditProduct extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $successMessage = '', $errorMessage = '';
    public $product, $productId, $categories, $brands, $productAttributes = [];
    public $discount, $start_discount, $end_discount, $quantity, $price, $sku;
    public $name_ar, $name_en, $desc_ar, $desc_en, $small_desc_ar, $small_desc_en, $category_id, $brand_id, $available_for, $tags;
    public $has_variants = 0, $manage_stock = 0, $has_discount = 0;
    public $variants, $prices = [], $quantities = [], $variantAttributes = [];
    public $images , $newImages;
    public $valueRowCount = 0;
    protected ProductService $productService;

    public function boot(ProductService $productService) {
        $this->productService = $productService;
    }

    public function mount($productId, $categories, $brands, $productAttributes)
    {
        $this->product = $this->productService->getProductWithEgarLoading($productId);
        $this->categories = $categories;
        $this->brands = $brands;
        $this->productAttributes = $productAttributes;

        $this->name_ar = $this->product->getTranslation('name', 'ar');
        $this->name_en = $this->product->getTranslation('name', 'en');
        $this->desc_ar = $this->product->getTranslation('desc', 'ar');
        $this->desc_en = $this->product->getTranslation('desc', 'en');
        $this->small_desc_ar = $this->product->getTranslation('small_desc', 'ar');
        $this->small_desc_en = $this->product->getTranslation('small_desc', 'en');
        $this->sku = $this->product->sku;
        $this->available_for = $this->product->available_for;
        $this->category_id = $this->product->category_id; //auto selected
        $this->brand_id = $this->product->brand_id; //auto selected
        $this->tags = $this->product->tags;

        $this->has_variants = $this->product->has_variants;
        $this->manage_stock = $this->product->manage_stock;
        $this->quantity = $this->product->quantity;
        $this->has_discount = $this->product->has_discount;
        $this->discount = $this->product->discount;
        $this->start_discount = $this->product->start_discount;
        $this->end_discount = $this->product->end_discount;
        $this->price = $this->product->price;

        $this->images = $this->product->images;

        if($this->has_variants) {
            $this->variants = $this->product->variants;
            $this->valueRowCount = count($this->variants);
            foreach($this->variants as $key=>$variant) {
                $this->prices[$key] = $variant->price;
                $this->quantities[$key] = $variant->stock;

                foreach($variant->variantAttributes as $variantAttribute) {
                    $this->variantAttributes[$key][$variantAttribute->attributeValue->attribute_id] = $variantAttribute->attribute_value_id;
                }
            }
        }

    }

    public function render()
    {
        return view('livewire.dashboard.edit-product');
    }

    public function firstStepSubmit() {
        $this->validate([
            'name_ar' => 'required|string|min:10|max:255',
            'name_en' => 'required|string|min:10|max:255',
            'small_desc_ar' => 'required|string|min:10|max:500',
            'small_desc_en' => 'required|string|min:10|max:500',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' =>  ['required', 'string' ,'unique:products,sku,'. $this->product->id],

            'available_for' => 'required|date|after_or_equal:today',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $data = [
            'has_variants'  => ['required', 'in:1,0'],
            'manage_stock'  => ['required', 'in:0,1'],
            'has_discount'  => ['required', 'in:1,0'],
        ];

        if (!$this->has_variants) {
            $data['price'] = ['required', 'numeric', 'min:1', 'max:100000'];
        }

        if ($this->manage_stock) {
            $data['quantity'] = ['required', 'numeric', 'min:1', 'max:100000'];
        }

        if ($this->has_discount) {
            $data['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $data['start_discount'] = ['required_if:has_discount,1', 'date', 'before:end_discount'];
            $data['end_discount'] = ['required_if:has_discount,1', 'date', 'after:start_discount'];
        }
        if ($this->has_variants) {
            $data['prices'] = ['required', 'array', 'min:1'];
            $data['prices.*'] = ['required', 'numeric', 'min:1', 'max:100000'];
            $data['quantities'] = ['required', 'array', 'min:1'];
            $data['quantities.*'] = ['required', 'numeric', 'min:0', 'max:100000'];
            $data['variantAttributes'] = ['required', 'array', 'min:1'];
            $data['variantAttributes.*'] = ['required', 'array'];
            $data['variantAttributes.*.*'] = ['required', 'integer' ,'exists:attribute_values,id'];
        }

        $this->validate($data);
        $this->currentStep = 3;
    }

    public function submitForm() {
        $productData = [
            'name' => ['ar' => $this->name_ar, 'en' => $this->name_en],
            'desc' => ['ar' => $this->desc_ar, 'en' => $this->desc_en],
            'small_desc' => ['ar' => $this->small_desc_ar, 'en' => $this->small_desc_en],
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku,
            'available_for' => $this->available_for,
            'has_variants' => $this->has_variants,
            'price' => $this->has_variants ? null : $this->price,
            'manage_stock' => $this->manage_stock,
            'quantity' => !$this->manage_stock? null : $this->quantity,
            'has_discount' => $this->has_discount,
            'discount' => !$this->has_discount? null : $this->discount,
            'start_discount' => !$this->has_discount? null : $this->start_discount,
            'end_discount' => !$this->has_discount? null : $this->end_discount,
        ];

        $productVariants = [];

        if($this->has_variants) {
            foreach ($this->prices as $key => $price) {
                $productVariants[] = [
                    'product_id' => $this->product->id,
                    'price' => $price,
                    'stock' => $this->quantities[$key] ?? 0,
                    'attribute_value_ids' => $this->variantAttributes[$key],
                ];
            }
        }


        $updatedProduct = $this->productService->updateProductWithDetails($this->product, $productData, $productVariants, $this->newImages);
        if(!$updatedProduct) {
            $this->errorMessage = __('static.global.failed_update');
            $this->currentStep = 1;
        }
        Session::flash('success', __('static.products.created_successfully'));
        return redirect()->route('dashboard.products.index');

    }

    public function addNewVariant() {
        $this->prices[] = null;
        $this->quantities[] = null;
        $this->variantAttributes[] = [];
        $this->valueRowCount = count($this->prices);
    }
    public function removeVariant() {
        if($this->valueRowCount > 1) {
            $this->valueRowCount--;
            array_pop($this->prices);
            array_pop($this->quantities);
            array_pop($this->variantAttributes);
        }
    }

    public function deleteImage($imageId, $key, $file_name) {
        unset($this->images[$key]);
        $this->productService->deleteProductImage($imageId, $file_name);
    }

    public function deleteNewImage($key) {
        unset($this->images[$key]);
    }

    public function back($step) {
        $this->currentStep = $step;
    }



}