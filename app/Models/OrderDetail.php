<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes, PowerJoins;

    protected $fillable = [
        'orderable_type', 'orderable_id', 'orderable_name', 'orderable_price', 'quantity', 'subtotal',
    ];

    protected $casts = [
        'orderable_id' => 'int',
        'order_id' => 'int',
        'quantity' => 'int',
        'orderable_price' => 'double',
        'subtotal' => 'double',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function orderable()
    {
        return $this->morphTo();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'order_detail_id');
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    // public function scopeNotReviewed($query){
    //     return $query->
    // }

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
}
