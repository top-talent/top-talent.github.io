<?php

namespace App\Models;

use App\Models\Traits\SelectHierarchyTrait;
use Baum\Node;

class Category extends Node
{
    use SelectHierarchyTrait;

    /**
     * The categories table.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The scoped nested set attributes.
     *
     * @var array
     */
    protected $scoped = ['belongs_to'];

    /**
     * The fillable category attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'belongs_to',
    ];

    /**
     * The columns to keep revisions of.
     *
     * @var array
     */
    protected $revisionColumns = [
        'name',
    ];

    /**
     * The revisionable field names.
     *
     * @var array
     */
    protected $revisionColumnsFormatted = [
        'name' => 'Name',
    ];

    /**
     * Returns a single lined string with arrows indicating depth of the current category.
     *
     * @return string
     */
    public function getTrailAttribute()
    {
        return renderNode($this);
    }
}
