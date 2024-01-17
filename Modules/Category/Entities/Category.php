<?php

namespace Modules\Category\Entities;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory , ImageTrait , Sluggable;

    protected $fillable = ['id' , 'name' , 'slug' , 'image' , 'parent_id'];

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

    /**
     * return sub categories
     *
     * @return HasMany
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

    /**
     * return parent category
     *
     * @return BelongsTo
     */
    public function mainCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'parent_id');
    }

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return $this->get_image($this->image,  'categories');
        }else{
            return 'https://placehold.co/600x400';
        }
    }
    
    public function getRouteKeyName()
    {
        return 'slug';   
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Category\Database\factories\CategoryFactory::new();
    // }
}
