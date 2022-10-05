<?php
namespace App\Models;

use Franzose\ClosureTable\Models\Entity;

class Category extends Entity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * ClosureTable model instance.
     *
     * @var \App\CategoryClosure
     */
    protected $closure = 'App\CategoryClosure';
}
