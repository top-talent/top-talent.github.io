<?php

namespace App\Http\Controllers\WorkOrder;

use App\Exceptions\WorkOrder\ReportExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOrder\ReportRequest;
use App\Processors\WorkOrder\WorkOrderReportProcessor;

class WorkOrderReportController extends Controller
{
    /**
     * @var WorkOrderReportProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderReportProcessor $processor
     */
    public function __construct(WorkOrderReportProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays the form for creating a report
     * for the specified work order.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function create($workOrderId)
    {
        try {
            return $this->processor->create($workOrderId);
        } catch (ReportExistsException $e) {
            flash()->error('Error!', 'This work order already has already been completed.');

            return redirect()->route('maintenance.work-orders.show', [$workOrderId]);
        }
    }

    /**
     * Creates a new report for the specified work order.
     *
     * @param ReportRequest $request
     * @param int|string    $workOrderId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReportRequest $request, $workOrderId)
    {
        if ($this->processor->store($request, $workOrderId)) {
            flash()->success('Success!', 'Successfully created work order report.');

            return redirect()->route('maintenance.work-orders.show', [$workOrderId]);
        } else {
            flash()->error('Error!', 'There was an issue creating a work order report. Please try again');

            return redirect()->route('maintenance.work-orders.report.create', [$workOrderId]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $workOrderId
     * @param $reportId
     */
    public function show($workOrderId, $reportId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $workOrderId
     * @param $reportId
     */
    public function edit($workOrderId, $reportId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $workOrderId
     * @param $reportId
     */
    public function update($workOrderId, $reportId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $workOrderId
     * @param $reportId
     */
    public function destroy($workOrderId, $reportId)
    {
        //
    }
}
