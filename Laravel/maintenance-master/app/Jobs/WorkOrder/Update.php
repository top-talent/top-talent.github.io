<?php

namespace App\Jobs\WorkOrder;

use App\Http\Requests\WorkOrder\WorkOrderRequest;
use App\Jobs\Job;
use App\Models\WorkOrder;

class Update extends Job
{
    /**
     * @var WorkOrderRequest
     */
    protected $request;

    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * Constructor.
     *
     * @param WorkOrderRequest $request
     * @param WorkOrder        $workOrder
     */
    public function __construct(WorkOrderRequest $request, WorkOrder $workOrder)
    {
        $this->request = $request;
        $this->workOrder = $workOrder;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->workOrder->category_id = $this->request->input('category');
        $this->workOrder->location_id = $this->request->input('location');
        $this->workOrder->status_id = $this->request->input('status');
        $this->workOrder->priority_id = $this->request->input('priority');
        $this->workOrder->subject = $this->request->input('subject');
        $this->workOrder->description = $this->request->clean($this->request->input('description'));
        $this->workOrder->started_at = $this->request->input('started_at');
        $this->workOrder->completed_at = $this->request->input('completed_at');

        if ($this->workOrder->save()) {
            $assets = $this->request->input('assets', []);

            if (is_array($assets) && count($assets) > 0) {
                $this->workOrder->assets()->sync($assets);
            }

            return true;
        }

        return false;
    }
}
