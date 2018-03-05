<?php

namespace App\Processors\WorkOrder;

use App\Exceptions\WorkOrder\ReportExistsException;
use App\Http\Presenters\WorkOrder\WorkOrderReportPresenter;
use App\Http\Requests\WorkOrder\ReportRequest;
use App\Jobs\WorkOrder\Report\Store;
use App\Models\WorkOrder;
use App\Models\WorkOrderReport;
use App\Processors\Processor;

class WorkOrderReportProcessor extends Processor
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var WorkOrderReport
     */
    protected $report;

    /**
     * @var WorkOrderReportPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkOrder                $workOrder
     * @param WorkOrderReport          $report
     * @param WorkOrderReportPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, WorkOrderReport $report, WorkOrderReportPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->report = $report;
        $this->presenter = $presenter;
    }

    /**
     * Displays the form for creating a work order report.
     *
     * @param int|string $workOrderId
     *
     * @throws ReportExistsException
     *
     * @return \Illuminate\View\View
     */
    public function create($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        if ($workOrder->isComplete()) {
            throw new ReportExistsException();
        }

        $form = $this->presenter->form($workOrder, $this->report);

        return view('work-orders.report.create', compact('form'));
    }

    /**
     * Creates a new work order report.
     *
     * @param ReportRequest $request
     * @param int|string    $workOrderId
     *
     * @return bool
     */
    public function store(ReportRequest $request, $workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $report = $this->report->newInstance();

        return $this->dispatch(new Store($request, $workOrder, $report));
    }

    public function show($workOrderId, $reportId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $report = $workOrder->report()->findOrFail($reportId);

        return view('work-orders.report', compact('workOrder', 'report'));
    }

    public function edit($workOrderId, $reportId)
    {
        //
    }

    public function update($workOrderId, $reportId)
    {
        //
    }

    public function destroy($workOrderId, $reportId)
    {
        //
    }
}
