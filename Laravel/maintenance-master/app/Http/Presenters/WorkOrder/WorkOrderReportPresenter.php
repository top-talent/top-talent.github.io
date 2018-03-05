<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Presenter;
use App\Models\Status;
use App\Models\WorkOrder;
use App\Models\WorkOrderReport;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;

class WorkOrderReportPresenter extends Presenter
{
    /**
     * Returns a new form of the specified work order report.
     *
     * @param WorkOrder       $workOrder
     * @param WorkOrderReport $report
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(WorkOrder $workOrder, WorkOrderReport $report)
    {
        return $this->form->of('work-orders.report', function (FormGrid $form) use ($workOrder, $report) {
            if ($report->exists) {
                $method = 'PATCH';
                $url = route('maintenance.work-orders.report.update', [$workOrder->getKey(), $report->getKey()]);
                $form->submit = 'Save';
            } else {
                $method = 'POST';
                $url = route('maintenance.work-orders.report.store', [$workOrder->getKey()]);
                $form->submit = 'Create';
            }

            $form->attributes(compact('method', 'url'));

            $form->with($report);

            $form->fieldset(function (Fieldset $fieldset) use ($workOrder) {
                $fieldset
                    ->control('select', 'status')
                    ->options(function () {
                        $statuses = Status::all()->pluck('name', 'id');
                        $statuses[0] = 'None';

                        return $statuses;
                    })
                    ->value(function () use ($workOrder) {
                        if ($workOrder->status instanceof Status) {
                            return $workOrder->status->getKey();
                        }
                    })
                    ->attributes([
                        'class' => 'select2',
                    ]);

                $fieldset->control('input:textarea', 'description');
            });
        });
    }
}
