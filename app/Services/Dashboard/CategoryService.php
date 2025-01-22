<?php

namespace App\Services\Dashboard;

use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\CategoryRepository;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategoriesForDatatables() {
        $categories = $this->categoryRepository->getAllCategories();
        return DataTables::of($categories)->addIndexColumn()
        ->addColumn('actions', function ($category) {
            return view('dashboard.categories.actions', compact('category'));
        })
        ->addColumn('name', function($category){
                return $category->getTranslation('name', app()->getLocale() );
        })->addColumn('status', function($category) {
            return view('dashboard.categories.statusFeild', compact('category'));
        })->make(true);
    }

    public function createCategory($data) {
        return $this->categoryRepository->createCategory($data);
    }

    public function updateCategory($id, $data) {
        $category = $this->categoryRepository->getCategory($id);
        return $this->categoryRepository->updateCategory($category, $data);
    }
    public function deleteCategory($id) {
        $category = $this->categoryRepository->getCategory($id);
        return $this->categoryRepository->deleteCategory($category);
    }

    public function getCategoriesForEditCategory($id) {
        $category = $this->categoryRepository->getCategoriesForEditCategory($id);
        return $category;
    }

    public function getParentCategories() {
        return $this->categoryRepository->getParentCategories();
    }

    public function getCategory($id) {
        return $this->categoryRepository->getCategory($id);
    }

    public function changeStatus($id) {
        $category = $this->categoryRepository->getCategory($id);
        if (!$category) {
            abort(404);
        }
        $category = $this->categoryRepository->changeStatus($category);
        if (!$category) {
            return false;
        }
        return $category;
    }

}