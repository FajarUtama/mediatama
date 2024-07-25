<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id_video';
    public $timestamps = false; 

    protected $fillable = [
        'title_video',
        'location_video',
    ];
}