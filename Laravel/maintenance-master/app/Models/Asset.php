<?php

namespace App\Models;

use App\Models\Traits\HasCategoryTrait;
use App\Models\Traits\HasEventsTrait;
use App\Models\Traits\HasLocationTrait;
use App\Models\Traits\HasUserTrait;
use App\Viewers\AssetViewer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    use HasUserTrait;
    use HasEventsTrait;
    use HasLocationTrait;
    use HasCategoryTrait;

    /**
     * The assets table.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The asset viewer class.
     *
     * @var string
     */
    protected $viewer = AssetViewer::class;

    /**
     * The fillable asset attribute.s.
     *
     * @var array
     */
    protected $fillable = [
        'import_id',
        'user_id',
        'location_id',
        'category_id',
        'tag',
        'name',
        'description',
        'condition',
        'size',
        'weight',
        'vendor',
        'make',
        'model',
        'serial',
        'price',
        'acquired_at',
        'end_of_life',
    ];

    /**
     * The columns to keep revisions of.
     *
     * @var array
     */
    protected $revisionColumns = [
        'location_id',
        'category_id',
        'name',
        'description',
        'condition',
        'size',
        'weight',
        'vendor',
        'make',
        'model',
        'serial',
        'price',
    ];

    /**
     * The revision column means attributes.
     *
     * @var array
     */
    protected $revisionColumnsMean = [
        'location_id' => 'revised_location',
        'category_id' => 'revised_category',
    ];

    /**
     * The revisionable formatted field names.
     *
     * @var array
     */
    protected $revisionColumnsFormatted = [
        'location_id' => 'Location',
        'category_id' => 'Category',
        'name'        => 'Name',
        'description' => 'Description',
        'condition'   => 'Condition',
        'size'        => 'Size',
        'weight'      => 'Weight',
        'vendor'      => 'Vendor',
        'make'        => 'Make',
        'model'       => 'Model',
        'serial'      => 'Serial',
        'price'       => 'Price',
        'acquired_at' => 'Acquired At',
        'end_of_life' => 'End of Life',
    ];

    /**
     * The belongsToMany images relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Attachment::class, 'asset_images', 'asset_id', 'attachment_id');
    }

    /**
     * The belongsToMany manuals relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function manuals()
    {
        return $this->belongsToMany(Attachment::class, 'asset_manuals', 'asset_id', 'attachment_id');
    }

    /**
     * The belongsToMany work orders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workOrders()
    {
        return $this->belongsToMany(WorkOrder::class, 'work_order_assets', 'asset_id', 'work_order_id');
    }

    /**
     * The belongsToMany meters relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meters()
    {
        return $this->belongsToMany(Meter::class, 'asset_meters', 'asset_id', 'meter_id');
    }

    /*
     * Filters query by the inputted asset name
     */

    public function scopeName($query, $name = null)
    {
        if ($name) {
            return $query->where('name', 'LIKE', '%'.$name.'%');
        }

        return $query;
    }

    /*
     * Filters query by the inputted asset condition
     */

    public function scopeCondition($query, $condition = null)
    {
        if ($condition) {
            return $query->where('condition', 'LIKE', '%'.$condition.'%');
        }

        return $query;
    }

    /*
     * Mutator for conversion of integer condition,
     * to text condition through translator.
     *
     * @return string|null
     */

    public function getConditionAttribute($condition = null)
    {
        if (!is_null($condition)) {
            return trans(sprintf('assets.conditions.%s', $condition));
        }

        return;
    }

    /**
     * Mutator for retrieving the condition number.
     *
     * @return int|null
     */
    public function getConditionNumberAttribute()
    {
        if (array_key_exists('condition', $this->attributes)) {
            return $this->attributes['condition'];
        }

        return;
    }

    /*
     * Mutator for displaying a pretty link label for display in work orders
     *
     * @return string.
     */

    public function getLabelAttribute()
    {
        return sprintf(
            '<a href="%s" class="label label-primary">%s</span></a>',
            route('maintenance.assets.show', [$this->attributes['id']]),
            $this->attributes['name']
        );
    }
}
