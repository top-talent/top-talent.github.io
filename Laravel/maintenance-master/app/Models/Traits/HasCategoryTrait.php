<?php

namespace App\Models\Traits;

use App\Models\Category;

trait HasCategoryTrait
{
    /**
     * The has one category relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Retrieves the revised location attribute.
     *
     * @param int|string $id
     *
     * @return null|string
     */
    public function getRevisedCategoryAttribute($id)
    {
        if ($id) {
            $category = $this->category()->find($id);

            if ($category instanceof Category) {
                return $category->trail;
            }
        }

        return;
    }

    /**
     * Filters results by specified category.
     *
     * @param mixed      $query
     * @param int|string $categoryId
     *
     * @return mixed
     */
    public function scopeCategory($query, $categoryId = null)
    {
        if ($categoryId) {
            // Get descendants and self inventory category nodes
            $categories = Category::find($categoryId)->getDescendantsAndSelf();

            // Perform a sub-query on main query
            $query->where(function ($query) use ($categories) {
                // For each category, apply a orWhere query to the sub-query
                foreach ($categories as $category) {
                    $query->orWhere('category_id', $category->id);
                }
            });
        }

        return $query;
    }
}
