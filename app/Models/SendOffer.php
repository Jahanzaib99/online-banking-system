<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function reciever() {
        return $this->belongsTo( User::class,'reciever_id');
    }

    public function sender() {
        return $this->belongsTo( User::class,'sender_id');
    }
    public function sparePartTpe() {
        return $this->belongsTo( SparePartTypes::class,'spare_part_type_id');
    }
}
