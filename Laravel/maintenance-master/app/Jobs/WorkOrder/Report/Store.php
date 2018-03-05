<?php

namespace App\Jobs\WorkOrder\Report;

use App\Http\Requests\WorkOrder\ReportRequest;
use App\Jobs\Job;
use App\Models\WorkOrder;
use App\Models\WorkOrderReport;

class Store extends Job
{
    /**
     * @var ReportRequest
     */
    protected $request;

    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var WorkOrderReport
     */
    protected $report;

    /**
     * Constructor.
     *
     * @param ReportRequest $request
     * @param WorkOrder     $workOrder
     */
    public function __construct(ReportRequest $request, WorkOrder $workOrder, WorkOrderReport $report)
    {
        $this->request = $request;
        $this->workOrder = $workOrder;
        $this->report = $report;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->report->user_id = auth()->id();
        $this->report->work_order_id = $this->workOrder->getKey();
        $this->report->description = $this->request->clean($this->request->input('description'));

        if ($this->report->save()) {
            $this->workOrder->complete($this->request->input('status'));

            return true;
        }

        return false;
    }
}
