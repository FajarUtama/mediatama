<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $table = 'admin'; 
    protected $primaryKey = 'id_admin'; 

    protected $fillable = [
        'username_admin', 'password_admin',
    ];

    protected $hidden = [
        'password_admin', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password_admin;
    }
}