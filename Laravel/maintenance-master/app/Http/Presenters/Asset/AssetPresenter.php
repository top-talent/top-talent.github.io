<?php

namespace App\Http\Presenters\Asset;

use App\Http\Presenters\Presenter;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Html\Table\Grid as TableGrid;

class AssetPresenter extends Presenter
{
    /**
     * Returns a new table of all assets.
     *
     * @param Asset $asset
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(Asset $asset)
    {
        return $this->table->of('assets', function (TableGrid $table) use ($asset) {
            $table->with($asset)->paginate($this->perPage);

            $table->attributes([
                'class' => 'table table-hover table-striped',
            ]);

            $table->column('tag');

            $table->column('name', function (Column $column) {
                $column->value = function (Asset $asset) {
                    return link_to_route('maintenance.assets.show', $asset->name, [$asset->getKey()]);
                };
            });

            $table->column('category', function (Column $column) {
                $column->value = function (Asset $asset) {
                    return $asset->category->trail;
                };
            });

            $table->column('location', function (Column $column) {
                $column->value = function (Asset $asset) {
                    return $asset->location->trail;
                };
            });

            $table->column('created_at');
        });
    }

    /**
     * Returns a new form for the specified asset.
     *
     * @param Asset $asset
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(Asset $asset)
    {
        return $this->form->of('assets', function (FormGrid $form) use ($asset) {
            if ($asset->exists) {
                $method = 'PATCH';
                $route = route('maintenance.assets.update', [$asset->getKey()]);
                $form->submit = 'Save';
            } else {
                $method = 'POST';
                $route = route('maintenance.assets.store');
                $form->submit = 'Create';
            }

            $categories = Category::getSelectHierarchy('assets');
            $locations = Location::getSelectHierarchy();

            $form->resource($this, $route, $asset, compact('method'));

            $form->fieldset(function (Fieldset $fieldset) use ($categories, $locations) {
                $fieldset
                    ->control('input:text', 'tag')
                    ->attributes([
                        'placeholder' => 'ex. 100010',
                    ]);

                $fieldset
                    ->control('input:text', 'name')
                    ->attributes([
                        'placeholder' => 'ex. Ford F150',
                    ]);

                $fieldset
                    ->control('select', 'category')
                    ->options($categories)
                    ->value(function (Asset $asset) {
                        return $asset->category_id;
                    });

                $fieldset
                    ->control('select', 'location')
                    ->options($locations)
                    ->value(function (Asset $asset) {
                        return $asset->location_id;
                    });

                $fieldset->control('input:textarea', 'description');

                $fieldset->control('select', 'condition')
                    ->options(trans('assets.conditions'))
                    ->value(function (Asset $asset) {
                        return $asset->condition_number;
                    });

                $fieldset->control('input:text', 'vendor')
                    ->attributes([
                        'placeholder' => 'ex. Ford',
                    ]);

                $fieldset->control('input:text', 'make')
                    ->attributes([
                        'placeholder' => 'ex. F',
                    ]);

                $fieldset->control('input:text', 'model')
                    ->attributes([
                        'placeholder' => 'ex. 150',
                    ]);

                $fieldset->control('input:text', 'serial')
                    ->attributes([
                        'placeholder' => 'ex. 153423-13432432-2342423',
                    ]);

                $fieldset->control('input:text', 'size')
                    ->attributes([
                        'placeholder' => 'ex. 1905 x 2463',
                    ]);

                $fieldset->control('input:text', 'weight')
                    ->attributes([
                        'placeholder' => 'ex. 1 Ton',
                    ]);

                $fieldset->control('input:text', 'acquired_at')
                    ->attributes([
                        'class'       => 'pickadate',
                        'placeholder' => 'Click to Select a Date',
                    ]);

                $fieldset->control('input:text', 'end_of_life')
                    ->attributes([
                        'class'       => 'pickadate',
                        'placeholder' => 'Click to Select a Date',
                    ]);
            });
        });
    }

    /**
     * Returns a new navbar for the asset index.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbar()
    {
        return $this->fluent([
            'id'         => 'assets',
            'title'      => 'Assets',
            'url'        => route('maintenance.assets.index'),
            'menu'       => view('assets._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }
}
