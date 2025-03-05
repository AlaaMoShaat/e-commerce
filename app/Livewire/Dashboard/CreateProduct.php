<?php

namespace App\Livewire\Dashboard;

use Attribute;
use App\Models\Product;
use Livewire\Component;
use App\Utils\ImageManeger;
use Livewire\WithFileUploads;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use App\Services\Dashboard\ProductService;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $successMessage = '';
    public $categories, $brands, $productAttributes;
    public $images, $discount, $start_discount, $end_discount, $quantity, $price, $sku;
    public $name_ar, $name_en, $desc_ar, $desc_en, $small_desc_ar, $small_desc_en, $category_id, $brand_id, $available_for, $tags;
    public $has_variants = 0, $manage_stock = 0, $has_discount = 0;
    public $prices = [], $quantities = [], $attributeValues = [];
    public $valueRowCount = 1;
    public $fullscreenImage = '';
    protected ProductService $productService;



    public function boot(ProductService $productService) {
        $this->productService = $productService;
    }

    public function mount($categories, $brands, $productAttributes)
    {
        $this->categories = $categories;
        $this->brands = $brands;
        $this->productAttributes = $productAttributes;
    }

    public function render()
    {
        return view('livewire.dashboard.create-product');
    }

    protected function rules() {
        return [
            'name_ar' => 'required|string|min:10|max:255',
            'name_en' => 'required|string|min:10|max:255',
            'small_desc_ar' => 'required|string|min:10|max:500',
            'small_desc_en' => 'required|string|min:10|max:500',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'required|string|unique:products,sku',
            'available_for' => 'required|date|after_or_equal:today',
            'tags' => 'required|string',

            // Product Variants
            'has_variants' => 'required|boolean',
            'price' => 'required_if:has_variants,0|numeric|min:0',
            'manage_stock' => 'required_if:has_variants,0|boolean',
            'quantity' => 'required_if:manage_stock,1|integer|min:1',

            // Discount Rules
            'has_discount' => 'required|boolean',
            'discount' => 'required_if:has_discount,1|numeric|min:0|max:100',
            'start_discount' => 'required_if:has_discount,1|date|after_or_equal:today',
            'end_discount' => 'required_if:has_discount,1|date|after:start_discount',

            // Variant Rules
            'prices.*' => 'required_if:has_variants,1|numeric|min:0',
            'quantities.*' => 'required_if:has_variants,1|integer|min:0',
            'attributeValues.*.*' => 'required_if:has_variants,1|exists:attribute_values,id',

            // Images
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ];
    }

    public function updated($propertyName)
    {
        // Validate only the field that changed
        $this->validateOnly($propertyName);
    }

    public function back($step) {
        $this->currentStep = $step;
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
            'sku' => 'required|string|unique:products,sku',
            'available_for' => 'required|date|after_or_equal:today',
            'tags' => 'required|string',
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
            $data['attributeValues'] = ['required', 'array', 'min:1'];
            $data['attributeValues.*'] = ['required', 'array'];
            $data['attributeValues.*.*'] = ['required', 'integer' ,'exists:attribute_values,id'];
        }

        $this->validate($data);
        $this->currentStep = 3;
    }

    public function addNewVariant() {
        $this->prices[] = null;
        $this->quantities[] = null;
        $this->attributeValues[] = [];
        $this->valueRowCount = count($this->prices);
    }
    public function removeVariant() {
        if($this->valueRowCount > 1) {
            $this->valueRowCount--;
            // unset($this->prices[$this->valueRowCount]);
            // unset($this->quantities[$this->valueRowCount]);
            // unset($this->attributeValues[$this->valueRowCount]);
            //Or
            array_pop($this->prices);
            array_pop($this->quantities);
            array_pop($this->attributeValues);
        }
    }

    public function deleteImage($key) {
        unset($this->images[$key]);
    }

    public function openFullscreen($key) {
        $this->fullscreenImage = $this->images[$key]->temporaryUrl();
        $this->dispatch('showFullScreenModal');
    }

    public function thirdStepSubmit() {
        $this->validate([
            'images' => ['required', 'array'],
            'images.*' => ['image','mimes:jpg,jpeg,png,gif|max:2048'],
        ]);
        $this->currentStep = 4;
    }

    public function submitForm() {
        $product = [
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
                    'product_id' => null,
                    'price' => $price,
                    'stock' => $this->quantities[$key] ?? 0,
                    'attribute_value_ids' => $this->attributeValues[$key],
                ];
            }
        }

        $this->productService->createProductWithDetails($product, $productVariants, $this->images);

        $this->successMessage = __('static.products.created_successfully');
        $this->resetExcept('categories', 'brands', 'productAttributes' ,'successMessage');
        $this->currentStep = 1;
    }

}