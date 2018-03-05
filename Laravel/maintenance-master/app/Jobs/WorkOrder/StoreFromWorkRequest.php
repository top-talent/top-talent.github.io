<?php

namespace App\Jobs\WorkOrder;

use App\Jobs\Job;
use App\Models\Priority;
use App\Models\Status;
use App\Models\WorkOrder;
use App\Models\WorkRequest;

class StoreFromWorkRequest extends Job
{
    /**
     * @var WorkRequest
     */
    protected $workRequest;

    /**
     * Constructor.
     *
     * @param WorkRequest $workRequest
     */
    public function __construct(WorkRequest $workRequest)
    {
        $this->workRequest = $workRequest;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        // We'll make sure the work request doesn't already have a
        // work order attached to it before we try and create it.
        if (!$this->workRequest->hasWorkOrder()) {
            $priority = Priority::findOrCreateRequested();

            $status = Status::findOrCreateRequested();

            $workOrder = new WorkOrder();

            $workOrder->status_id = $status->getKey();
            $workOrder->priority_id = $priority->getKey();
            $workOrder->request_id = $this->workRequest->getKey();
            $workOrder->user_id = $this->workRequest->user_id;
            $workOrder->subject = $this->workRequest->subject;
            $workOrder->description = $this->workRequest->description;

            if ($workOrder->save()) {
                return $workOrder;
            }
        }

        return false;
    }
}
