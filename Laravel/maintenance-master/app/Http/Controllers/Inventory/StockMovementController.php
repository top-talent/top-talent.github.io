<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller as BaseController;
use App\Services\Inventory\InventoryService;
use App\Services\Inventory\StockMovementService;
use App\Services\Inventory\StockService;

class StockMovementController extends BaseController
{
    /**
     * @var InventoryService
     */
    protected $inventory;

    /**
     * @var StockService
     */
    protected $inventoryStock;

    /**
     * @var StockMovementService
     */
    protected $inventoryStockMovement;

    /**
     * @param InventoryService     $inventory
     * @param StockService         $inventoryStock
     * @param StockMovementService $inventoryStockMovement
     */
    public function __construct(InventoryService $inventory, StockService $inventoryStock, StockMovementService $inventoryStockMovement)
    {
        $this->inventory = $inventory;
        $this->inventoryStock = $inventoryStock;
        $this->inventoryStockMovement = $inventoryStockMovement;
    }

    /**
     * Displays all the stock movement entries for the specified stock for the
     * specified inventory.
     *
     * @param $inventory_id
     * @param $stock_id
     *
     * @return mixed
     */
    public function index($inventory_id, $stock_id)
    {
        $item = $this->inventory->find($inventory_id);
        $stock = $this->inventoryStock->find($stock_id);

        $data = $this->inputAll();
        $data['stock_id'] = $stock->id;

        $movements = $this->inventoryStockMovement->setInput($data)->getByPageWithFilter();

        return view('inventory.stocks.movements.index', [
            'title'     => "Viewing Stock Movements for Item: $item->name in Location: ".renderNode($stock->location),
            'item'      => $item,
            'stock'     => $stock,
            'movements' => $movements,
        ]);
    }

    /**
     * Displays a stock movement record.
     *
     * @param $inventory_id
     * @param $stock_id
     * @param $movement_id
     */
    public function show($inventory_id, $stock_id, $movement_id)
    {
        $item = $this->inventory->find($inventory_id);
        $stock = $this->inventoryStock->find($stock_id);
        $movement = $this->inventoryStockMovement->find($movement_id);

        return view('inventory.stocks.movements.show', [
            'title'    => 'Viewing Movement: '.$movement->id,
            'item'     => $item,
            'stock'    => $stock,
            'movement' => $movement,
        ]);
    }

    /**
     * Rolls back an inventory stock movement.
     *
     * @param $inventory_id
     * @param $stock_id
     * @param $movement_id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function rollback($inventory_id, $stock_id, $movement_id)
    {
        $item = $this->inventory->find($inventory_id);
        $stock = $this->inventoryStock->find($stock_id);
        $movement = $this->inventoryStockMovement->find($movement_id);

        if ($stock->rollback($movement)) {
            $this->message = 'Successfully rolled back movement';
            $this->messageType = 'success';
            $this->redirect = routeBack('maintenance.inventory.stock.movements.index', [
                $item->id, $stock->id,
            ]);
        } else {
            $this->message = 'There was an error trying to roll back this movement. Please try again.';
            $this->messageType = 'success';
            $this->redirect = routeBack('maintenance.inventory.stock.movements.index', [
                $item->id, $stock->id,
            ]);
        }

        return $this->response();
    }
}
