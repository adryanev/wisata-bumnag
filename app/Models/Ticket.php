<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, PowerJoins, BlameableTrait;

    protected $fillable = [
        'name',
        'price',
        'is_free',
        'term_and_conditions',
        'is_quantity_limited',
        'quantity',
        'description',
        'ticketable_type',
        'ticketable_id',
    ];
    protected $casts = [
        'is_free' => 'boolean',
        'is_quantity_limited' => 'boolean',
        'price' => 'double',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            'name' => 'required',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function ordersDetail()
    {
        return $this->morphMany(OrderDetail::class, 'orderable');
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function destination()
    {
        return $this->hasOne(Destination::class, 'destination_id');
    }
    public function ticketSetting()
    {
        return $this->hasOne(TicketSetting::class);
    }
    public function ticketable()
    {
        return $this->morphTo();
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
}
