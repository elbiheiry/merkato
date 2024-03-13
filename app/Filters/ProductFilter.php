<?php

namespace App\Filters;

class ProductFilter extends Filters
{
    protected $var_filters = ['category', 'type'];

    public function category($category)
    {
        return $this->builder->whereHas('category', function ($query) use ($category) {
            $query->where('id', $category)->orWhereHas('mainCategory', function ($query2) use ($category) {
                $query2->where('id', $category);
            });
        });
    }

    public function type($type)
    {
        return $this->builder->whereJsonContains('types', $type);
    }
}
