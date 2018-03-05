<?php

namespace App\Models\Traits;

use Baum\Node;

trait SelectHierarchyTrait
{
    /**
     * Returns the complete nested set table in a nested list.
     *
     * @param string $belongsTo
     *
     * @return array
     */
    public static function getSelectHierarchy($belongsTo = null)
    {
        $query = static::roots();

        if (!is_null($belongsTo)) {
            $query->where('belongs_to', $belongsTo);
        }

        $roots = $query->with('children')->get();

        $options = [0 => 'None'];

        foreach ($roots as $root) {
            $options = $options + static::getRenderedNode($root);
        }

        return $options;
    }

    /**
     * Renders the specified category and it's children in single dimension array.
     *
     * @param Node $node
     *
     * @return array
     */
    public static function getRenderedNode(Node $node)
    {
        $options = [];

        if ($node->isRoot()) {
            $name = $node->name;
        } else {
            $depth = str_repeat('--', $node->depth);

            $name = sprintf('%s %s', $depth, $node->name);
        }

        $options[$node->id] = $name;

        if ($node->children()->count() > 0) {
            foreach ($node->children as $child) {
                $options = $options + static::getRenderedNode($child);
            }
        }

        return $options;
    }
}
