<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;

class WorkOrderNotification extends Model
{
    use HasUserTrait;

    /**
     * The work order notifications table.
     *
     * @var string
     */
    protected $table = 'work_order_notifications';

    /**
     * The fillable work order notification attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'work_order_id',
        'status',
        'priority',
        'parts',
        'customer_updates',
        'technician_updates',
        'completion_report',
    ];

    /**
     * The hasOne work order relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function workOrder()
    {
        return $this->hasOne('App\Models\WorkOrder', 'id', 'work_order_id');
    }
}
