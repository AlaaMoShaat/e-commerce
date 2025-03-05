<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\BrandService;
use App\Services\Dashboard\ProductService;
use App\Services\Dashboard\CategoryService;
use App\Services\Dashboard\AttributeService;

class ProductController extends Controller
{

    protected $productService, $categoryService, $brandService, $attributeService;
    public function __construct(ProductService $productService, CategoryService $categoryService, BrandService $brandService, AttributeService $attributeService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->attributeService = $attributeService;

    }
    public function index()
    {
        return view('dashboard.products.products.index');
    }

    public function getAllProducts() {
        return $this->productService->getProductsForDataTable();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $productAttributes = Attribute::with('attributeValues')->get();
        return view('dashboard.products.products.create', compact('brands', 'categories', 'productAttributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProduct($id);
        return view('dashboard.products.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productId = $id;
        $categories = $this->categoryService->getCategories();
        $brands = $this->brandService->getBrands();
        $attributes = $this->attributeService->getAttributes();
        return view('dashboard.products.products.edit', compact('productId', 'categories', 'brands', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->deleteProduct($id);
        if (!$product) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id) {
        $product = $this->productService->changeStatus($id);
        if (!$product) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $product = $this->productService->getProduct($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $product], 200);
    }

    public function deleteVariant($id) {
        $variant = $this->productService->deleteVariant($id);
        if (!$variant) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }
}
