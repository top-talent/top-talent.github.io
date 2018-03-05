<?php

namespace App\Http\Presenters\WorkRequest;

use App\Http\Presenters\Presenter;
use App\Models\WorkRequest;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;

class WorkRequestPresenter extends Presenter
{
    /**
     * Returns a new table of all work requests.
     *
     * @param WorkRequest $workRequest
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table($workRequest)
    {
        return $this->table->of('work-requests', function (TableGrid $table) use ($workRequest) {
            $table->with($workRequest)->paginate($this->perPage);

            $table->attributes([
                'class' => 'table table-hover table-striped',
            ]);

            $table->column('ID', 'id');

            $table->column('subject', function (Column $column) {
                $column->value = function (WorkRequest $workRequest) {
                    return link_to_route('maintenance.work-requests.show', $workRequest->subject, [$workRequest->getKey()]);
                };
            });

            $table->column('best_time');

            $table->column('created_at');
        });
    }

    /**
     * Returns a new form for the specified work request.
     *
     * @param WorkRequest $request
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(WorkRequest $request)
    {
        return $this->form->of('work-requests', function (FormGrid $form) use ($request) {
            if ($request->exists) {
                $method = 'PATCH';
                $url = route('maintenance.work-requests.update', [$request->getKey()]);
                $form->submit = 'Save';
            } else {
                $method = 'POST';
                $url = route('maintenance.work-requests.store');
                $form->submit = 'Create';
            }

            $form->with($request);

            $form->attributes(compact('method', 'url'));

            $form->fieldset(function (Fieldset $fieldset) {
                $fieldset
                    ->control('input:text', 'subject')
                    ->attributes([
                        'placeholder' => 'Enter Subject',
                    ]);

                $fieldset
                    ->control('input:text', 'best_time')
                    ->attributes([
                        'placeholder' => 'Enter Best Time',
                    ]);

                $fieldset
                    ->control('input:textarea', 'description');
            });
        });
    }

    /**
     * Returns a new navbar for the work request index.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbar()
    {
        return $this->fluent([
            'id'         => 'work-requests',
            'title'      => 'Work Requests',
            'menu'       => view('work-requests._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }
}
