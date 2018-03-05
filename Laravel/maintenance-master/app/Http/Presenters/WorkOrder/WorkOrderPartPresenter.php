<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Inventory\InventoryPresenter;
use App\Http\Presenters\Presenter;
use App\Models\Inventory;
use App\Models\InventoryStock;
use App\Models\WorkOrder;
use Orchestra\Contracts\Html\Table\Column;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;

class WorkOrderPartPresenter extends Presenter
{
    /**
     * Returns a new table of all parts attached to the specified work order.
     *
     * @param WorkOrder $workOrder
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function table(WorkOrder $workOrder)
    {
        $parts = $workOrder->parts();

        return $this->table->of('work-orders.parts', function (TableGrid $table) use ($workOrder, $parts) {
            $table->with($parts)->paginate($this->perPage);

            $table->pageName = 'page-parts';

            $table->column('ID', 'id');

            $table->column('SKU', function (Column $column) {
                $column->value = function (InventoryStock $stock) {
                    return $stock->item->getSku();
                };
            });

            $table->column('name', function (Column $column) {
                $column->value = function (InventoryStock $stock) {
                    return $stock->item->name;
                };
            });

            $table->column('location', function (Column $column) {
                $column->value = function (InventoryStock $stock) {
                    return $stock->location->trail;
                };
            });

            $table->column('taken', function (Column $column) {
                $column->value = function (InventoryStock $stock) {
                    return $stock->quantity;
                };
            });

            $table->column('return', function (Column $column) use ($workOrder) {
                $column->label = 'Return Stock';
                $column->value = function (InventoryStock $stock) use ($workOrder) {
                    $route = 'maintenance.work-orders.parts.stocks.put';

                    $params = [$workOrder->getKey(), $stock->item->getKey(), $stock->getKey()];

                    $attributes = [
                        'class' => 'btn btn-default btn-sm',
                    ];

                    return link_to_route($route, 'Return', $params, $attributes);
                };
            });
        });
    }

    /**
     * Displays all inventory available for selection.
     *
     * @param WorkOrder $workOrder
     * @param Inventory $inventory
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function tableInventory(WorkOrder $workOrder, Inventory $inventory)
    {
        $inventory = $inventory->noVariants();

        return $this->table->of('work-orders.inventory', function (TableGrid $table) use ($inventory, $workOrder) {
            $table->with($inventory)->paginate($this->perPage);

            $table->pageName = 'page-inventory';

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
     * Returns a new navbar for the work order parts table.
     *
     * @param WorkOrder $workOrder
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbarParts(WorkOrder $workOrder)
    {
        return $this->fluent([
            'id'         => 'work-orders-parts',
            'title'      => 'Parts Added',
            'url'        => route('maintenance.work-orders.parts.index', [$workOrder->getKey()]),
            'menu'       => view('work-orders.parts._nav', compact('workOrder')),
            'attributes' => [
                'class' => 'navbar-default',
            ],
        ]);
    }

    /**
     * Returns a new navbar for the inventory table.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function navbarInventory()
    {
        $presenter = new InventoryPresenter($this->form, $this->table);

        return $presenter->navbar();
    }
}
