<?php

namespace App\Viewers;

use App\Models\WorkOrder;
use App\Models\WorkRequest;

class UpdateViewer extends BaseViewer
{
    public function clientWorkRequest(WorkRequest $workRequest)
    {
        return view('viewers.update.client-work-request', [
            'workRequest' => $workRequest,
            'update'      => $this->entity,
        ]);
    }

    /**
     * Returns the work requests updates view.
     *
     * @param WorkRequest $workRequest
     *
     * @return \Illuminate\View\View
     */
    public function workRequest(WorkRequest $workRequest)
    {
        return view('viewers.update.work-request', [
            'workRequest' => $workRequest,
            'update'      => $this->entity,
        ]);
    }

    /**
     * Returns the work orders updates view.
     *
     * @param WorkOrder $workOrder
     *
     * @return \Illuminate\View\View
     */
    public function workOrder(WorkOrder $workOrder)
    {
        return view('viewers.update.work-order', [
            'workOrder' => $workOrder,
            'update'    => $this->entity,
        ]);
    }
}
