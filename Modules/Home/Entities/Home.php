<?php

namespace Modules\Home\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'title1' , 'title2'
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Home\Database\factories\HomeFactory::new();
    // }
}
