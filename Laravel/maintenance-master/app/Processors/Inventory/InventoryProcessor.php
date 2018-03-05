<?php

namespace App\Processors\Inventory;

use App\Http\Presenters\Inventory\InventoryPresenter;
use App\Http\Requests\Inventory\InventoryRequest;
use App\Jobs\Inventory\Store;
use App\Jobs\Inventory\Update;
use App\Models\Inventory;
use App\Processors\Processor;

class InventoryProcessor extends Processor
{
    /**
     * @var Inventory
     */
    protected $inventory;

    /**
     * @var InventoryPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param Inventory          $inventory
     * @param InventoryPresenter $presenter
     */
    public function __construct(Inventory $inventory, InventoryPresenter $presenter)
    {
        $this->inventory = $inventory;
        $this->presenter = $presenter;
    }

    /**
     * Displays all inventory items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $inventory = $this->presenter->tableNoVariants($this->inventory);

        $navbar = $this->presenter->navbar();

        return view('inventory.index', compact('inventory', 'navbar'));
    }

    /**
     * Displays the form for creating a new inventory item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->inventory);

        return view('inventory.create', compact('form'));
    }

    /**
     * Creates a new inventory item.
     *
     * @param InventoryRequest $request
     *
     * @return bool
     */
    public function store(InventoryRequest $request)
    {
        $item = $this->inventory->newInstance();

        return $this->dispatch(new Store($request, $item));
    }

    /**
     * Displays the specified inventory item.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $item = $this->inventory->find($id);

        $variants = $this->presenter->tableVariants($item);

        $stocks = $this->presenter->tableStocks($item);

        $navbarProfile = $this->presenter->navbarProfile($item);

        $navbarVariants = $this->presenter->navbarVariants($item);

        $navbarStocks = $this->presenter->navbarStocks($item);

        return view('inventory.show', compact(
            'item',
            'stocks',
            'variants',
            'navbarProfile',
            'navbarVariants',
            'navbarStocks'
        ));
    }

    /**
     * Displays the form for editing the specified inventory item.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->inventory->findOrFail($id);

        $form = $this->presenter->form($item);

        return view('inventory.edit', compact('form'));
    }

    /**
     * Updates the specified inventory item.
     *
     * @param InventoryRequest $request
     * @param int|string       $id
     *
     * @return bool
     */
    public function update(InventoryRequest $request, $id)
    {
        $item = $this->inventory->findOrFail($id);

        return $this->dispatch(new Update($request, $item));
    }

    /**
     * Deletes the specified inventory item.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $item = $this->inventory->findOrFail($id);

        return $item->delete();
    }
}
