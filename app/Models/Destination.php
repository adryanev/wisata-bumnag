<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','description','address','phone_number','email','latitude','longitude','opening_hours','closing_hours','instagram','website','capasity'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'numeric|required',
            'email' => 'email|required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'date_format:H:i|nullable',
            'closing_hours' => 'date_format:H:i|nullable',
            'instagram' => 'nullable',
            'website' => 'url|nullable',
            'capasity' => 'numeric|min:1|nullable'
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function destinationCategory()
    {
        return $this->hasMany(DestinationCategory::class);
    }
    public function destinationCertifications()
    {
        return $this->hasMany(DestinationCertification::class);
    }
    public function ordersDetail()
    {
        return $this->morphMany(OrderDetail::class, 'orderable');
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
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
