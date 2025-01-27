<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\CategoryService;
use App\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $categoryService;
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function getAllCategories() {
        $categories = $this->categoryService->getAllCategoriesForDatatables();
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getParentCategories();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only(['name', 'parent','status']);
        $category = $this->categoryService->createCategory($data);
        if (!$category) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getCategory($id);
        $categories = $this->categoryService->getCategoriesForEditCategory($id);
        return view('dashboard.categories.edit', compact(['categories', 'category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->only(['name', 'status', 'parent']);

        $category = $this->categoryService->updateCategory($id, $data);
        if (!$category) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->deleteCategory($id);
        if (!$category) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id) {
        $category = $this->categoryService->changeStatus($id);
        if (!$category) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $category = $this->categoryService->getCategory($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $category], 200);
    }
}