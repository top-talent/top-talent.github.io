<?php

namespace App\Jobs\WorkOrder\Session;

use App\Jobs\Job;
use App\Models\WorkOrder;

class End extends Job
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
        $session = $this->workOrder->getLastUsersSession(auth()->id());

        $session->out = $session->freshTimestamp();

        return $session->save();
    }
}
