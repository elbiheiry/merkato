<?php

namespace Modules\Product\Entities;

use App\Filters\ProductFilter;
use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory , ImageTrait , Sluggable;

    protected $fillable = ['id' , 'name' , 'description' , 'price' , 'category_id' , 'type_id' , 'slug' , 'image'];

    protected $hidden = ['created_at' , 'updated_at'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getImagePathAttribute()
    {
        if (Storage::disk('public')->exists('categories/'.$this->image)) {
            return $this->get_image($this->image,  'categories');
        }else{
            return 'https://placehold.co/600x400';
        }
    }

    public function scopeFilter($query,ProductFilter $filter)
    {
        return $filter->apply($query);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';   
    }
}