<?php

namespace Modules\Home\Entities;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{
    use HasFactory , ImageTrait;

    protected $fillable = [
        'id' , 'name' , 'image' , 'related_products'
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Home\Database\factories\OfferFactory::new();
    // }

    public function getImagePathAttribute()
    {
        if (Storage::disk('public')->exists('offers/'.$this->image)) {
            return $this->get_image($this->image,  'offers');
        }else{
            return $this->image;
        }
    }
}
