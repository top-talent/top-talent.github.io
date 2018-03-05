<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Presenter;
use App\Models\WorkOrder;
use App\Models\WorkOrderSession;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;

class WorkOrderSessionPresenter extends Presenter
{
    /**
     * Returns a new table of all work order sessions.
     *
     * @param WorkOrder $workOrder
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(WorkOrder $workOrder)
    {
        $sessions = $workOrder->sessions();

        return $this->table->of('work-orders.sessions', function (TableGrid $table) use ($sessions) {
            $table->with($sessions)->paginate($this->perPage);

            $table->attributes([
                'class' => 'table table-hover table-striped',
            ]);

            $table->column('user', function (Column $column) {
                $column->value = function (WorkOrderSession $session) {
                    return $session->user->fullname;
                };
            });

            $table->column('Hours', function (Column $column) {
                $column->value = function (WorkOrderSession $session) {
                    return $session->getHours();
                };
            });

            $table->column('in');

            $table->column('out', function (Column $column) {
                $column->value = function (WorkOrderSession $session) {
                    return $session->getOutLabel();
                };
            });
        });
    }

    /**
     * Displays unique sessions per worker and totals their hours.
     *
     * @param WorkOrder $workOrder
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tablePerWorker(WorkOrder $workOrder)
    {
        $sessions = $workOrder->getUniqueSessions();

        return $this->table->of('work-orders.sessions.per-worker', function (TableGrid $table) use ($sessions) {
            $table->with($sessions);

            $table->attributes([
                'class' => 'table table-hover table-striped',
            ]);

            $table->column('worker', function (Column $column) {
                $column->value = function (WorkOrderSession $session) {
                    return $session->user->fullname;
                };
            });

            $table->column('total_hours', function (Column $column) {
                $column->value = function (WorkOrderSession $session) {
                    return $session->total_hours;
                };
            });
        });
    }

    /**
     * Returns a new navbar for the current work orders sessions.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbar()
    {
        return $this->fluent([
            'id'         => 'work-order-sessions',
            'title'      => 'Work Order Sessions',
            'menu'       => view('work-orders.sessions._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }
}
