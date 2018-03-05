<?php

namespace App\Models;

use App\Viewers\WorkOrder\AssignmentViewer;

class WorkOrderAssignment extends Model
{
    /**
     * The work order assignments table.
     *
     * @var string
     */
    protected $table = 'work_order_assignments';

    /**
     * The fillable work order assignment attributes.
     *
     * @var array
     */
    protected $fillable = [
        'work_order_id',
        'by_user_id',
        'to_user_id',
    ];

    /**
     * The work order assignment viewer.
     *
     * @var string
     */
    protected $viewer = AssignmentViewer::class;

    /**
     * The hasOne work order relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function workOrder()
    {
        return $this->hasOne(WorkOrder::class, 'id', 'work_order_id');
    }

    /**
     * The hasOne by user relationship indicating who assigned the 'toUser'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function byUser()
    {
        return $this->hasOne(User::class, 'id', 'by_user_id');
    }

    /**
     * The hasOne to user relationship indicating who assigned user is.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toUser()
    {
        return $this->hasOne(User::class, 'id', 'to_user_id');
    }

    /**
     * Returns an html label of the assigned user.
     *
     * @return string
     */
    public function getLabelAttribute()
    {
        return sprintf('<span class="label label-default">%s</span>', $this->toUser->full_name);
    }
}
