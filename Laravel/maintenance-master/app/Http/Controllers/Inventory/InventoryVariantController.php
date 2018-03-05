<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\InventoryRequest;
use App\Processors\Inventory\InventoryVariantProcessor;

class InventoryVariantController extends Controller
{
    /**
     * @var InventoryVariantProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param InventoryVariantProcessor $processor
     */
    public function __construct(InventoryVariantProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays the form for creating a variant
     * of the specified inventory.
     *
     * @param int|string $itemId
     *
     * @return \Illuminate\View\View
     */
    public function create($itemId)
    {
        return $this->processor->create($itemId);
    }

    /**
     * Processes creating a variant of the specified
     * inventory item.
     *
     * @param InventoryRequest $request
     * @param int|string       $itemId
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(InventoryRequest $request, $itemId)
    {
        if ($this->processor->store($request, $itemId)) {
            flash()->success('Success!', 'Successfully created variant.');

            return redirect()->route('maintenance.inventory.show', [$itemId, '#tab-variants']);
        } else {
            flash()->error('Error!', 'There was an error creating a variant of this item. Please try again.');

            return redirect()->route('maintenance.inventory.variants.create', [$itemId]);
        }
    }
}
