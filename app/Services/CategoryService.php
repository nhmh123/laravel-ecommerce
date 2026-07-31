<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Kiểm tra parent mới có hợp lệ không.
     */
    public function canMove(Category $category, ?int $parentId): bool
    {
        if ($parentId === null) {
            return true;
        }

        if ($category->id === $parentId) {
            return false;
        }

        return !$this->isDescendant($category, $parentId);
    }

    /**
     * Kiểm tra parentId có nằm trong cây con của category không.
     */
    private function isDescendant(Category $category, int $parentId): bool
    {
        $category->loadMissing('childrenRecursive');

        foreach ($category->childrenRecursive as $child) {
            if ($child->id === $parentId) {
                return true;
            }

            if ($this->isDescendant($child, $parentId)) {
                return true;
            }
        }

        return false;
    }
}
