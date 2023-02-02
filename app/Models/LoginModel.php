<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LoginModel extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['id','email','password'];
    protected $hidden = ['password'];
}
