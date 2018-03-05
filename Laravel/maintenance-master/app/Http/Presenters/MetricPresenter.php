<?php

namespace App\Http\Presenters;

use App\Models\Metric;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;

class MetricPresenter extends Presenter
{
    /**
     * Returns a new table of all metrics.
     *
     * @param Metric $metric
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(Metric $metric)
    {
        return $this->table->of('metrics', function (TableGrid $table) use ($metric) {
            $table->with($metric)->paginate($this->perPage);

            $table->column('name');
            $table->column('symbol');
            $table->column('Created', 'created_at');
        });
    }

    /**
     * Returns a new form for the specified metric.
     *
     * @param Metric $metric
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(Metric $metric)
    {
        return $this->form->of('metrics', function (FormGrid $form) use ($metric) {
            if ($metric->exists) {
                $method = 'PATCH';
                $url = route('maintenance.metrics.update', [$metric->getKey()]);
                $form->submit = 'Save';
            } else {
                $method = 'POST';
                $url = route('maintenance.metrics.store');
                $form->submit = 'Create';
            }

            $form->attributes(compact('method', 'url'));

            $form->with($metric);

            $form->fieldset(function (Fieldset $fieldset) {
                $fieldset
                    ->control('input:text', 'name')
                    ->attributes([
                        'placeholder' => 'ex. Tonnes, Pounds, Grams',
                    ]);

                $fieldset
                    ->control('input:text', 'symbol')
                    ->attributes([
                        'placeholder' => 'ex. T, LBS, G',
                    ]);
            });
        });
    }

    /**
     * Returns a new navbar for the metric index.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbar()
    {
        return $this->fluent([
            'id'         => 'metrics',
            'title'      => 'Metrics',
            'menu'       => view('metrics._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }
}
