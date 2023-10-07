<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'user_id' , 'region' , 'area' , 'address' , 'facility' , 'floor' , 'is_default'];

    protected $hidden = ['created_at' , 'updated_at'];

    // protected static function newFactory()
    // {
    //     return \Modules\User\Database\factories\AddressFactory::new();
    // }
}
