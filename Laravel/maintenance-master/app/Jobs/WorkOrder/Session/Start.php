<?php

namespace App\Jobs\WorkOrder\Session;

use App\Jobs\Job;
use App\Models\WorkOrder;
use App\Models\WorkOrderSession;

class Start extends Job
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * Constructor.
     *
     * @param WorkOrder $workOrder
     */
    public function __construct(WorkOrder $workOrder)
    {
        $this->workOrder = $workOrder;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $session = new WorkOrderSession();

        $session->user_id = auth()->id();
        $session->work_order_id = $this->workOrder->id;
        $session->in = $session->freshTimestamp();

        if ($this->workOrder->sessions->count() === 0 || is_null($this->workOrder->started_at)) {
            $this->workOrder->update(['started_at' => $this->workOrder->freshTimestamp()]);
        }

        return $session->save();
    }
}
