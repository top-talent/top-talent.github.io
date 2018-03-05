<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\StatusViewer;
use Orchestra\Support\Facades\HTML;

class Status extends Model
{
    use HasUserTrait;

    /**
     * The statuses table.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The status viewer.
     *
     * @var string
     */
    protected $viewer = StatusViewer::class;

    /**
     * The fillable status attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];

    /**
     * Finds or creates the default requested status.
     *
     * @return Priority
     */
    public static function findOrCreateRequested()
    {
        return (new static())->firstOrCreate([
            'name'  => 'Requested',
            'color' => 'default',
        ]);
    }

    /**
     * Returns an html label with the color of the status.
     *
     * @return string
     */
    public function getLabel()
    {
        $color = $this->color;

        return HTML::create('span', $this->name, ['class' => "label label-$color"]);
    }

    /**
     * An accessor for the getLabel method.
     *
     * @return string
     */
    public function getLabelAttribute()
    {
        return (string) $this->getLabel();
    }
}
