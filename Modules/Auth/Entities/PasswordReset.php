<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordReset extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const id = null;
    protected $fillable = ['email' , 'token'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Auth\Database\factories\PasswordResetFactory::new();
    // }
}
