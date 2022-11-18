<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Order extends Model
{
    use HasFactory, SoftDeletes, PowerJoins;

    const STATUS_CREATED = 0;
    const STATUS_PAID = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_REFUNDED = 4;

    protected $fillable = [
        'total_price',
        'number',
        'note',
        'status',
        'user_id',
        'order_date',
        'payment_type',
    ];

    protected $casts = [
        'status' => 'int',
        'total_price' => 'double',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    public function scopeCreated($query)
    {
        return $query->where('status', self::STATUS_CREATED);
    }
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }
    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }
    public function scopeRefunded($query)
    {
        return $query->where('status', self::STATUS_REFUNDED);
    }



    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
}
