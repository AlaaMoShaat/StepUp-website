<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllCategories() {
        return Category::latest()->get();
    }
    public function getCategory($id) {
        return Category::find($id);
    }

    public function createCategory($data) {
        $category = Category::create($data);
        return $category;
    }

    public function updateCategory($category, $data) {

        $category->update($data);
        return $category;
    }

    public function deleteCategory($category) {
        return $category->delete();
    }

    public function getCategoriesForEditCategory($id) {
        $categories = Category::where('id', '!=', $id)->whereNull('parent')->get();
        return $categories;
    }

    public function getParentCategories() {
        $categories = Category::whereNull('parent')->get();
        return $categories;
    }

    public function changeStatus($category)
    {
        $category = $category->update([
            'status' => $category->status == '1' ? '0' : '1',
        ]);
        return $category;
    }
 }