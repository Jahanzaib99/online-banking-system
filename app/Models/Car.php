<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function carModel() {
        return $this->belongsTo(CarModel::class);
    }

    public function Make() {
        return $this->belongsTo(Make::class);
    }

    public function spareParts() {
        return $this->hasMany(SparePart::class);
    }

    public function scopeSearch($query, $keywords)
    {
        return $query
            ->where('registration', 'like', "%" . $keywords . "%");
    }
}
