<?php

namespace App\Models;

use App\Models\Traits\SelectHierarchyTrait;
use Baum\Node;

class Location extends Node
{
    use SelectHierarchyTrait;

    /**
     * The locations table.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * The fillable location attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
     * The revision formatted field name attributes.
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
