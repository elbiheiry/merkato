<?php

namespace Modules\Home\Entities;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory , ImageTrait;

    protected $fillable = ['title' , 'subtitle' , 'image' ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Home\Database\factories\BannerFactory::new();
    // }

    public function getImagePathAttribute()
    {
        if (Storage::disk('public')->exists('banners/'.$this->image)) {
            return $this->get_image($this->image,  'banners');
        }else{
            return $this->image;
        }
    }
}
