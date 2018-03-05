<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Presenter;
use App\Models\Priority;
use App\Models\User;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;
use Orchestra\Support\Facades\HTML;

class WorkOrderPriorityPresenter extends Presenter
{
    /**
     * Returns a new table of all priorities.
     *
     * @param Priority $priority
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(Priority $priority)
    {
        return $this->table->of('work-orders.priorities', function (TableGrid $table) use ($priority) {
            $table->with($priority);

            $table->column('priority', function (Column $column) {
                $column->value = function (Priority $priority) {
                    return link_to_route('maintenance.work-orders.priorities.edit', $priority->getLabel(), [$priority->getKey()]);
                };
            });

            $table->column('created_at');

            $table->column('created_by', function (Column $column) {
                $column->value = function (Priority $priority) {
                    if ($priority->user instanceof User) {
                        return $priority->user->getRecipientName();
                    } else {
                        return HTML::create('em', 'None');
                    }
                };
            });
        });
    }

    /**
     * Returns a new form for priorities.
     *
     * @param Priority $priority
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(Priority $priority)
    {
        return $this->form->of('work-orders.priorities', function (FormGrid $form) use ($priority) {
            if ($priority->exists) {
                $url = route('maintenance.work-orders.priorities.update', [$priority->getKey()]);
                $method = 'PATCH';
                $form->submit = 'Save';
            } else {
                $url = route('maintenance.work-orders.priorities.store');
                $method = 'POST';
                $form->submit = 'Create';
            }

            $colors = config('maintenance.colors', []);

            $form->attributes(compact('method', 'url'));

            $form->with($priority);

            $form->fieldset(function (Fieldset $fieldset) use ($colors) {
                $fieldset
                    ->control('input:text', 'name')
                    ->attributes([
                        'placeholder' => 'ex. High / Low',
                    ]);

                $fieldset
                    ->control('select', 'color')
                    ->options($colors)
                    ->value(function (Priority $priority) {
                        return $priority->color;
                    })
                    ->attributes([
                        'class' => 'select2-color',
                    ]);
            });
        });
    }

    /**
     * Returns a new navbar for the priorities index.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbar()
    {
        return $this->fluent([
            'id'         => 'work-orders-priorities',
            'title'      => 'Priorities',
            'menu'       => view('work-orders.priorities._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }
}
