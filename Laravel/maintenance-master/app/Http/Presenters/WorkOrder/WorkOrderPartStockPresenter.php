<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Presenter;
use App\Models\Inventory;
use App\Models\InventoryStock;
use App\Models\WorkOrder;
use Orchestra\Contracts\Html\Form\Field;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;

class WorkOrderPartStockPresenter extends Presenter
{
    /**
     * Returns a new table of stocks for the specified inventory
     * item for work order part selection.
     *
     * @param WorkOrder $workOrder
     * @param Inventory $item
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(WorkOrder $workOrder, Inventory $item)
    {
        $stocks = $item->stocks();

        return $this->table->of('work-orders.parts.stocks', function (TableGrid $table) use ($workOrder, $item, $stocks) {
            $table->with($stocks)->paginate($this->perPage);

            $table->column('location', function (Column $column) use ($item) {
                $column->value = function (InventoryStock $stock) use ($item) {
                    $name = $stock->location->trail;

                    return link_to_route('maintenance.inventory.stocks.show', $name, [$item->getKey(), $stock->getKey()]);
                };
            });

            $table->column('quantity');

            $table->column('select', function (Column $column) use ($workOrder, $item) {
                $column->value = function (InventoryStock $stock) use ($workOrder, $item) {
                    $route = 'maintenance.work-orders.parts.stocks.take';

                    $params = [$workOrder->getKey(), $item->getKey(), $stock->getKey()];

                    $attributes = [
                        'class' => 'btn btn-default btn-sm',
                    ];

                    return link_to_route($route, 'Select', $params, $attributes);
                };
            });
        });
    }

    /**
     * Returns a new table of specified items variants available
     * for selection on the current work order.
     *
     * @param WorkOrder $workOrder
     * @param Inventory $item
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tableVariants(WorkOrder $workOrder, Inventory $item)
    {
        $variants = $item->variants();

        return $this->table->of('work-orders.parts.variants', function (TableGrid $table) use ($variants, $workOrder) {
            $table->with($variants)->paginate($this->perPage);

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

            $table->column('select', function (Column $column) use ($workOrder) {
                $column->value = function (Inventory $item) use ($workOrder) {
                    $route = 'maintenance.work-orders.parts.stocks.index';

                    $params = [$workOrder->getKey(), $item->getKey()];

                    $attributes = [
                        'class' => 'btn btn-default btn-sm',
                    ];

                    return link_to_route($route, 'Select', $params, $attributes);
                };
            });
        });
    }

    /**
     * Returns a new form for taking stock from the specified
     * inventory for the specified work order.
     *
     * @param WorkOrder      $workOrder
     * @param Inventory      $inventory
     * @param InventoryStock $stock
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function formTake(WorkOrder $workOrder, Inventory $inventory, InventoryStock $stock)
    {
        return $this->form->of('work-orders.parts.stocks.take', function (FormGrid $form) use ($workOrder, $inventory, $stock) {
            $form->attributes([
                'method' => 'POST',
                'url'    => route('maintenance.work-orders.parts.stocks.take', [$workOrder->getKey(), $inventory->getKey(), $stock->getKey()]),
            ]);

            $form->submit = 'Save';

            $form->fieldset(function (Fieldset $fieldset) use ($inventory) {
                $metric = $inventory->getMetricSymbol();

                $fieldset
                    ->control('input:text', 'quantity')
                    ->value(0)
                    ->attribute([
                        'placeholder' => "Enter Quantity in $metric",
                    ]);
            });
        });
    }

    /**
     * Returns a new form for putting the stock from the
     * specified work order back into inventory.
     *
     * @param WorkOrder      $workOrder
     * @param Inventory      $inventory
     * @param InventoryStock $stock
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function formPut(WorkOrder $workOrder, Inventory $inventory, InventoryStock $stock)
    {
        return $this->form->of('work-orders.parts.stocks.put', function (FormGrid $form) use ($workOrder, $inventory, $stock) {
            $form->attributes([
                'method' => 'POST',
                'url'    => route('maintenance.work-orders.parts.stocks.put', [$workOrder->getKey(), $inventory->getKey(), $stock->getKey()]),
            ]);

            $form->submit = 'Save';

            $form->fieldset(function (Fieldset $fieldset) use ($inventory, $stock) {
                $metric = $inventory->getMetricSymbol();

                $fieldset
                    ->control('input:text', 'quantity', function (Field $field) {
                        $field->label = 'Return Quantity';
                    })
                    ->value($stock->pivot->quantity)
                    ->attribute([
                        'placeholder' => "Enter Quantity in $metric",
                    ]);
            });
        });
    }
}
