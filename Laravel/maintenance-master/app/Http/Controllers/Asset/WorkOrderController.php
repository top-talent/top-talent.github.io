<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller as BaseController;
use App\Repositories\Asset\Repository as AssetRepository;

class WorkOrderController extends BaseController
{
    /**
     * @var AssetRepository
     */
    protected $asset;

    /**
     * Constructor.
     *
     * @param AssetRepository $asset
     */
    public function __construct(AssetRepository $asset)
    {
        $this->asset = $asset;
    }

    /**
     * Displays all work orders attached to the specified asset.
     *
     * @param int|string $assetId
     *
     * @return \Illuminate\View\View
     */
    public function index($assetId)
    {
        $asset = $this->asset->find($assetId);

        return view('assets.work-orders.index', compact('asset'));
    }

    /**
     * Displays all work orders available to be attached to the specified asset.
     *
     * @param int|string $assetId
     *
     * @return \Illuminate\View\View
     */
    public function attach($assetId)
    {
        $asset = $this->asset->find($assetId);

        return view('assets.work-orders.attach.index', compact('asset'));
    }

    /**
     * Attaches the specified work order to the specified asset.
     *
     * @param int|string $assetId
     * @param int|string $workOrderId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($assetId, $workOrderId)
    {
        if ($this->asset->attachWorkOrder($assetId, $workOrderId)) {
            $message = 'Successfully attached work order.';

            return redirect()->route('maintenance.assets.work-orders.index', [$assetId])->withSuccess($message);
        } else {
            $message = 'There was an issue attaching this work order. Please try again.';

            return redirect()->route('maintenance.assets.work-orders.attach.index', [$assetId])->withErrors($message);
        }
    }

    /**
     * Removes the specified work order from the specified asset.
     *
     * @param int|string $assetId
     * @param int|string $workOrderId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($assetId, $workOrderId)
    {
        if ($this->asset->detachWorkOrder($assetId, $workOrderId)) {
            $message = 'Successfully detached work order.';

            return redirect()->route('maintenance.assets.work-orders.index', [$assetId])->withSuccess($message);
        } else {
            $message = 'There was an issue detaching this work order. Please try again.';

            return redirect()->route('maintenance.assets.work-orders.index', [$assetId])->withErrors($message);
        }
    }
}
