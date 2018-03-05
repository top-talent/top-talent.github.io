<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\InventoryRequest;
use App\Processors\Inventory\InventoryProcessor;

class InventoryController extends Controller
{
    /**
     * @var InventoryProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param InventoryProcessor $processor
     */
    public function __construct(InventoryProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Display all inventory entries (paginated with search functionality).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Show the form for creating an inventory item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Creates a new inventory item.
     *
     * @param InventoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InventoryRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created inventory item.');

            return redirect()->route('maintenance.inventory.index');
        } else {
            flash()->error('Error!', 'There was an issue creating an inventory item. Please try again.');

            return redirect()->route('maintenance.inventory.create');
        }
    }

    /**
     * Display the specified inventory.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return $this->processor->show($id);
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
        return $this->processor->edit($id);
    }

    /**
     * Updates the specified inventory item.
     *
     * @param InventoryRequest $request
     * @param int|string       $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InventoryRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully updated inventory item.');

            return redirect()->route('maintenance.inventory.show', [$id]);
        } else {
            flash()->error('Error!', 'There was an issue updating this inventory item. Please try again.');

            return redirect()->route('maintenance.inventory.edit', [$id]);
        }
    }

    /**
     * Deletes the specified inventory item.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted inventory item.');

            return redirect()->route('maintenance.inventory.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this inventory item. Please try again.');

            return redirect()->route('maintenance.inventory.show', [$id]);
        }
    }
}
