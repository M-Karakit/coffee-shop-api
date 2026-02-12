<?php

namespace App\Services\Category;

use App\Models\Category\Category;
use Exception;

class CategoryService
{
    public function listCategories(array $filters = []) {
        try {
            return Category::query()
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
}
