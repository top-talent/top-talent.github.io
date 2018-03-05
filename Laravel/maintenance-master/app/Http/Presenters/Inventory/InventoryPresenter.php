<?php

namespace App\Http\Presenters\Inventory;

use App\Http\Presenters\Presenter;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Metric;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;

class InventoryPresenter extends Presenter
{
    /**
     * Returns a table of all inventory items.
     *
     * @param Inventory|\Illuminate\Database\Eloquent\Builder $item
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table($item)
    {
        return $this->table->of('inventory', function (TableGrid $table) use ($item) {
            $table->with($item)->paginate($this->perPage);

            $table->attributes([
                'class' => 'table table-hover table-striped',
            ]);

            $table->column('ID', 'id');

            $table->column('sku', function (Column $column) {
                $column->label = 'SKU';

                $column->value = function (Inventory $item) {
                    return $item->getSku();
                };
            });

            $table->column('name', function (Column $column) {
                $column->value = function (Inventory $item) {
                    return link_to_route('maintenance.inventory.show', $item->name, [$item->getKey()]);
                };
            });

            $table->column('category', function (Column $column) {
                $column->value = function (Inventory $item) {
                    return $item->category->trail;
                };
            });

            $table->column('current_stock', function (Column $column) {
                $column->value = function (Inventory $item) {
                    return $item->getTotalStock();
                };
            });
        });
    }

    /**
     * Returns a table of all of the specified inventory items variants.
     *
     * @param Inventory|\Illuminate\Database\Eloquent\Builder $item
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tableVariants($item)
    {
        return $this->table($item->variants());
    }

    /**
     * Returns a table of all inventory items that are not variants.
     *
     * @param int|string $item
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tableNoVariants($item)
    {
        return $this->table($item->noVariants());
    }

    /**
     * Returns a table of stocks for the specified inventory item.
     *
     * @param Inventory $item
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tableStocks(Inventory $item)
    {
        return (new InventoryStockPresenter($this->form, $this->table))->table($item);
    }

    /**
     * Returns a new form for creating a new inventory item.
     *
     * @param Inventory  $inventory
     * @param bool|false $variant
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(Inventory $inventory, $variant = false)
    {
        return $this->form->of('inventory', function (FormGrid $form) use ($inventory, $variant) {
            if ($inventory->exists) {
                if ($variant === true) {
                    // If the inventory item exists and we're looking to create a form
                    // for a variant, we'll set the forms options accordingly.
                    $method = 'POST';
                    $url = route('maintenance.inventory.variants.store', [$inventory->getKey()]);
                    $form->submit = 'Create';
                } else {
                    // Otherwise we'll set the options to update the specified inventory item.
                    $method = 'PATCH';
                    $url = route('maintenance.inventory.update', [$inventory->getKey()]);
                    $form->submit = 'Save';
                }
            } else {
                $method = 'POST';
                $url = route('maintenance.inventory.store');
                $form->submit = 'Create';
            }

            $form->with($inventory);

            $form->attributes(compact('method', 'url'));

            $categories = Category::getSelectHierarchy('inventories');

            $metrics = Metric::all()->pluck('name', 'id');
            $metrics->put(0, 'None');

            $form->fieldset(function (Fieldset $fieldset) use ($categories, $metrics) {
                $fieldset
                    ->control('select', 'category')
                    ->value(function (Inventory $item) {
                        return $item->category_id;
                    })
                    ->options($categories);

                $fieldset
                    ->control('select', 'metric')
                    ->value(function (Inventory $item) {
                        return $item->metric_id;
                    })
                    ->options($metrics);

                $fieldset
                    ->control('input:text', 'name')
                    ->attributes([
                        'placeholder' => 'ex. Nails',
                    ]);

                $fieldset->control('input:textarea', 'description');
            });
        });
    }

    /**
     * Returns a new navbar for the inventory index.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbar()
    {
        return $this->fluent([
            'id'         => 'inventory',
            'title'      => 'Inventory',
            'url'        => route('maintenance.inventory.index'),
            'menu'       => view('inventory._nav'),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }

    /**
     * Returns a new navbar for the specified inventory profile.
     *
     * @param Inventory $item
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbarProfile(Inventory $item)
    {
        return $this->fluent([
            'id'         => 'inventory-profile',
            'title'      => 'Profile',
            'menu'       => view('inventory._nav-profile', compact('item')),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }

    /**
     * Returns a new navbar for the inventory index.
     *
     * @param Inventory $item
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbarVariants(Inventory $item)
    {
        return $this->fluent([
            'id'         => 'inventory-variants',
            'title'      => 'Item Variants',
            'menu'       => view('inventory.variants._nav', compact('item')),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }

    /**
     * Returns a new navbar for the inventory stocks index.
     *
     * @param Inventory $item
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbarStocks(Inventory $item)
    {
        return (new InventoryStockPresenter($this->form, $this->table))->navbar($item);
    }
}
