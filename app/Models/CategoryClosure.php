<?php
namespace App\Models;

use Franzose\ClosureTable\Models\ClosureTable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryClosure extends ClosureTable
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_closure';
}
