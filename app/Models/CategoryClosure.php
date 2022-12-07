<?php

namespace App\Models;

use Franzose\ClosureTable\Models\ClosureTable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class CategoryClosure extends ClosureTable
{
    use SoftDeletes, PowerJoins;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_closure';
}
