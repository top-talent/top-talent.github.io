<?php

namespace App\Models;

use App\Models\Traits\HasScopeIdTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Schema;
use Stevebauman\EloquentTable\TableTrait;
use Stevebauman\Revision\Traits\HasRevisionsTrait;
use Stevebauman\Viewer\Traits\ViewableTrait;

class Model extends Eloquent
{
    /*
     * Provides easy table generation.
     */
    use TableTrait;

    /*
     * Provides scope for viewing a specific record ID.
     */
    use HasScopeIdTrait;

    /*
     * Provides reusable views when an object is returned.
     */
    use ViewableTrait;

    /*
     * Provides model revisions.
     */
    use HasRevisionsTrait;

    /**
     * The morphMany revisions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function revisions()
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

    /**
     * Returns the revision user ID.
     *
     * @return int
     */
    public function revisionUserId()
    {
        return auth()->id();
    }

    /**
     * Formats the created_at timestamp.
     *
     * @param string $createdAt
     *
     * @return string
     */
    public function getCreatedAtAttribute($createdAt)
    {
        return Carbon::parse($createdAt)->format('Y-m-d h:i A');
    }

    /**
     * Accessor for retrieving a limited description for display on tables.
     *
     * @return string
     */
    public function getLimitedDescriptionAttribute()
    {
        if (array_key_exists('description', $this->attributes)) {

            /*
             * Strip tags due to HTML formatting that may be inside the description
             * that could ruin the display of the table
             */
            return str_limit(strip_tags($this->attributes['description']), 30);
        }

        return;
    }

    /**
     * Retrieves a valid operator from the specified string.
     *
     * @param string $string
     *
     * @return bool|array
     */
    protected function getOperator($string)
    {
        $allowed_operators = ['>', '<', '=', '>=', '<='];

        $output = preg_split("/[\[\]]/", $string);

        if (is_array($output)) {
            if (array_key_exists('1', $output) && array_key_exists('2', $output)) {
                if (in_array($output[1], $allowed_operators)) {
                    return [$output[1], $output[2]];
                }
            } else {
                return $output;
            }
        }

        return false;
    }

    /**
     * Scopes a query to show only soft deleted records.
     *
     * @param object $query
     * @param bool   $archived
     *
     * @return object
     */
    public function scopeArchived($query, $archived = false)
    {
        if ($archived) {
            return $query->onlyTrashed();
        }

        return $query;
    }

    /**
     * Allows all columns on the current database table to be sorted through
     * query scope.
     *
     * @param object $query
     * @param string $field
     * @param string $sort
     *
     * @return object
     */
    public function scopeSort($query, $field = null, $sort = null)
    {
        /*
         * Make sure both the field and sort variables are present
         */
        if ($field && $sort) {
            /*
             * Retrieve all column names for the current model table
             */
            $columns = Schema::getColumnListing($this->getTable());

            /*
             * Make sure the field inputted is available on the current table
             */
            if (in_array($field, $columns)) {

                /*
                 * Make sure the sort input is equal to asc or desc
                 */
                if ($sort === 'asc' || $sort === 'desc') {
                    /*
                     * Return the query sorted
                     */
                    return $query->orderBy($field, $sort);
                }
            }
        }

        /*
         * Default to latest scope
         */
        return $query->latest();
    }
}
