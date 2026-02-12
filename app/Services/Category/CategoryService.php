<?php

namespace App\Services\Category;

use App\Models\Category\Category;
use Exception;

class CategoryService
{
    public function listCategories(array $filters = []) {
        try {
            return Category::query()
            ->with('products')
            ->filter($filters)
            ->latest()
            ->paginate(10);
        } catch (Exception $e) {
            throw new \Exception("Error listing categories: " . $e->getMessage());
        }
    }

    public function createCategory(array $data) {
        try {
            return Category::create($data);
        } catch (\Exception $e) {
            throw new \Exception("Error creating category: " . $e->getMessage());
        }
    }

    public function showCategory(Category $category) {
        try {
            return $category->load('products');
        } catch (\Exception $e) {
            throw new \Exception("Error Show Category: " . $e->getMessage());
        }
    }

    public function updateCategory(Category $category ,array $data) {
        try {
            $category->update(array_filter($data));
            return $category;
        } catch (\Exception $e) {
            throw new \Exception("Error updating category: " . $e->getMessage());
        }
    }

    public function deleteCategory(Category $category) {
        try {
            $category->delete();
        } catch (\Exception $e) {
            throw new \Exception("Error deleting category: " . $e->getMessage());
        }
    }
}
