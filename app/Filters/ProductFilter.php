<?php

namespace App\Filters;

class ProductFilter extends Filters
{
    protected $var_filters = ['category', 'type'];

    public function category($category)
    {
        return $this->builder->where('category_id' , $category);
    }

    public function type($type)
    {
        return $this->builder->where('type_id' , $type);
    }
}