<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\MetricViewer;

class Metric extends Model
{
    use HasUserTrait;

    /**
     * The metrics table.
     *
     * @var string
     */
    protected $table = 'metrics';

    /**
     * The fillable metric attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'symbol',
    ];

    /**
     * The metric viewer class.
     *
     * @var string
     */
    protected $viewer = MetricViewer::class;
}
