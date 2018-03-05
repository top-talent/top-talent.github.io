<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;

class WorkOrderReport extends Model
{
    use HasUserTrait;

    /**
     * The work order reports table.
     *
     * @var string
     */
    protected $table = 'work_order_reports';

    /**
     * The fillable work order report attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'work_order_id',
        'description',
    ];

    /**
     * The hasOne work order trait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function workOrder()
    {
        return $this->hasOne('App\Models\WorkOrder', 'id', 'work_order_id');
    }
}
