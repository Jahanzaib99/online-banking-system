<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function sparePartType() {
        return $this->belongsTo( SparePartTypes::class);
    }

    public function user() {
        return $this->belongsTo( User::class);
    }
}
