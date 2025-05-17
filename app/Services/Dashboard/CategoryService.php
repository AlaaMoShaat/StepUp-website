<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Facades\Cache;
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

    public function getCategories() {
        return $this->categoryRepository->getAllCategories();
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
        $category = $this->categoryRepository->createCategory($data);
        if(!$category) {
            return false;
        }
        self::categoryCache();
        return $category;
    }

    public function updateCategory($id, $data) {
        $category = $this->categoryRepository->getCategory($id);
        return $this->categoryRepository->updateCategory($category, $data);
    }
    public function deleteCategory($id) {
        $category = $this->categoryRepository->getCategory($id);
        $category = $this->categoryRepository->deleteCategory($category);
        self::categoryCache();
        return $category;
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
        self::categoryCache();
        return $category;
    }

    public function categoryCache() {
        Cache::forget('categories_count');
    }
}