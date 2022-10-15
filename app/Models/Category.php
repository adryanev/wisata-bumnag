<?php
namespace App\Models;

use Franzose\ClosureTable\Models\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Entity
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    protected $fillable = ['name','position','parent_id'];


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

    public function destination()
    {
        return $this->hasMany(Destination::class);
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
