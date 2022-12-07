<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinationCategory extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    // protected $fillable = ['category_id','destination_id'];

    // /*
    // |------------------------------------------------------------------------------------
    // | Validations
    // |------------------------------------------------------------------------------------
    // */
    // public static function rules($update = false, $id = null)
    // {
    //     return [
    //         'name' => 'required',
    //     ];
    // }

    // /*
    // |------------------------------------------------------------------------------------
    // | Relations
    // |------------------------------------------------------------------------------------
    // */
    // public function destination()
    // {
    //     return $this->belongsTo(Destination::class, 'destination_id');
    // }
    // public function category()
    // {
    //     return $this->hasOne(Category::class, 'category_id');
    // }
    // /*
    // |------------------------------------------------------------------------------------
    // | Scopes
    // |------------------------------------------------------------------------------------
    // */

    // /*
    // |------------------------------------------------------------------------------------
    // | Attributes
    // |------------------------------------------------------------------------------------
    // */
}
