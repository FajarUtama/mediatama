<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RequestAccess extends Model
{
    protected $table = 'request';
    protected $primaryKey = 'id_request';
    public $timestamps = false;

    protected $fillable = [
        'id_video',
        'id_user',
        'id_admin',
        'time_accept',
        'time_expired',
        'allow_access',
    ];

    protected $dates = ['time_accept', 'time_expired'];

    public function getTimeAcceptAttribute($value)
    {
        return is_string($value) ? Carbon::parse($value) : $value;
    }

    public function getTimeExpiredAttribute($value)
    {
        return is_string($value) ? Carbon::parse($value) : $value;
    }
}
