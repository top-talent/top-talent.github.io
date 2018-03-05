<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\WorkOrder\SessionViewer;
use Illuminate\Database\Eloquent\Builder;
use Orchestra\Support\Facades\HTML;

class WorkOrderSession extends Model
{
    use HasUserTrait;

    /**
     * The work order sessions table.
     *
     * @var string
     */
    protected $table = 'work_order_sessions';

    /**
     * The work order session viewer.
     *
     * @var string
     */
    protected $viewer = SessionViewer::class;

    /**
     * The fillable work order session attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'work_order_id',
        'in',
        'out',
        'hours',
    ];

    /**
     * The hasOne work order relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function workOrder()
    {
        return $this->hasOne(WorkOrder::class, 'work_order_id');
    }

    /**
     * Returns a query scope of sessions grouped by users.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeUnique(Builder $builder)
    {
        $select = 'user_id, TRUNCATE(ABS(SUM(TIME_TO_SEC(TIMEDIFF(work_order_sessions.in, work_order_sessions.out)) / 3600)), 2) as total_hours';

        return $builder->selectRaw($select)->groupBy('user_id');
    }

    /**
     * Returns the number of hours a session lasted with decimals.
     *
     * @return null|int
     */
    public function getHours()
    {
        if (array_key_exists('out', $this->attributes)) {
            if ($this->attributes['out']) {
                $hours = abs(round((strtotime($this->attributes['in']) - strtotime($this->attributes['out'])) / 3600, 2));

                return $hours;
            }
        }

        return;
    }

    /**
     * Returns a label if the current users session is open,
     * otherwise it will return the out datetime.
     *
     * @return string
     */
    public function getOutLabel()
    {
        if (is_null($this->out)) {
            return HTML::create('span', 'Open', ['class' => 'label label-success']);
        } else {
            return $this->out;
        }
    }
}
