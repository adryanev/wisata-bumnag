<?php

namespace App\Models;

use Franzose\ClosureTable\Models\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Category extends Entity
{
    use SoftDeletes, PowerJoins;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    protected $fillable = ['name', 'position', 'parent_id'];


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

    /**
     * ClosureTable model instance.
     *
     * @var \App\CategoryClosure
     */
    protected $closure = CategoryClosure::class;

    public function destinations()
    {
        return $this->hasMany(Destination::class)->using(DestinationCategory::class, 'destination_categories');
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
