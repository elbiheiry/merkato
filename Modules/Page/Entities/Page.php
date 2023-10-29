<?php

namespace Modules\Page\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = ['id' , 'slug' , 'name' , 'description'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Page\Database\factories\PageFactory::new();
    // }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
