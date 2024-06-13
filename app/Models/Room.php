<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];
    public function getImageAttribute($value)
    {
        if ($value != null && $value != '') {
            return url('uploads/rooms/' . $value);
        }
        return $value;
    }
}
