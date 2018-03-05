<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Presenter;
use App\Models\Status;
use App\Models\User;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;
use Orchestra\Support\Facades\HTML;

class WorkOrderStatusPresenter extends Presenter
{
    /**
     * Returns a new table of all statuses.
     *
     * @param Status $status
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(Status $status)
    {
        return $this->table->of('work-orders.statuses', function (TableGrid $table) use ($status) {
            $table->with($status)->paginate($this->perPage);

            $table->column('Status', function (Column $column) {
                $column->value = function (Status $status) {
                    return link_to_route('maintenance.work-orders.statuses.edit', $status->getLabel(), [$status->getKey()]);
                };
            });

            $table->column('created_at');

            $table->column('created_by', function (Column $column) {
                $column->value = function (Status $status) {
                    if ($status->user instanceof User) {
                        return $status->user->getRecipientName();
                    } else {
                        return HTML::create('em', 'None');
                    }
                };
            });
        });
    }

    /**
     * Returns a new form of the specified status.
     *
     * @param Status $status
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(Status $status)
    {
        return $this->form->of('work-orders.statuses', function (FormGrid $form) use ($status) {
            if ($status->exists) {
                $method = 'PATCH';
                $url = route('maintenance.work-orders.statuses.update', [$status->getKey()]);
                $form->submit = 'Save';
            } else {
                $method = 'POST';
                $url = route('maintenance.work-orders.statuses.store', [$status->getKey()]);
                $form->submit = 'Create';
            }

            $colors = config('maintenance.colors', []);

            $form->with($status);

            $form->attributes(compact('method', 'url'));

            $form->fieldset(function (Fieldset $fieldset) use ($colors) {
                $fieldset
                    ->control('input:text', 'name')
                    ->attributes([
                        'placeholder' => 'ex. Awaiting Parts / Supplies',
                    ]);

                $fieldset
                    ->control('select', 'color')
                    ->options($colors)
                    ->value(function (Status $status) {
                        return $status->color;
                    })
                    ->attributes([
                        'class' => 'select2-color',
                    ]);
            });
        });
    }

    public function navbar()
    {
        return $this->fluent([
            'id'         => 'work-orders-statuses',
            'title'      => 'Statuses',
            'menu'       => view('work-orders.statuses._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }
}
