<?php

namespace Modules\Type\Entities;

use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Type extends Model
{
    use HasFactory , ImageTrait , Sluggable;

    protected $fillable = ['id' , 'name' , 'slug' , 'image' , 'minimum' , 'free_shipping'];

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
        if (Storage::disk('public')->exists('types/'.$this->image)) {
            return $this->get_image($this->image,  'types');
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
    //     return \Modules\Type\Database\factories\TypeFactory::new();
    // }
}
