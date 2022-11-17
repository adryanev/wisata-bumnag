<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class TicketSetting extends Model
{
    use HasFactory, SoftDeletes, PowerJoins;

    protected $fillable = [
        'ticket_id',
        'is_per_pax',
        'pax_constraint',
        'is_per_day',
        'day_constraint',
        'is_per_age',
        'age_constraint',
    ];
    protected $casts = [
        'is_per_pax' => 'boolean',
        'is_per_day' => 'boolean',
        'is_per_age' => 'boolean',
	'ticket_id' => 'int',
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
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
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
