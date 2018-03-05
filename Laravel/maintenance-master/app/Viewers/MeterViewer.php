<?php

namespace App\Viewers;

use  App\Models\Asset;

class MeterViewer extends BaseViewer
{
    /**
     * Returns the meters action buttons view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.meter.buttons.actions', ['meter' => $this->entity]);
    }

    /**
     * Returns the meters edit button
     * view for the specified asset.
     *
     * @param Asset $asset
     *
     * @return \Illuminate\View\View
     */
    public function btnEditForAsset(Asset $asset)
    {
        return view('viewers.meter.buttons.edit-asset', ['asset' => $asset, 'meter' => $this->entity]);
    }

    /**
     * Returns the meters delete button
     * view for the specified asset.
     *
     * @param Asset $asset
     *
     * @return \Illuminate\View\View
     */
    public function btnDeleteForAsset(Asset $asset)
    {
        return view('viewers.meter.buttons.delete-asset', ['asset' => $asset, 'meter' => $this->entity]);
    }

    /**
     * Returns the meters actions button
     * view for the specified asset.
     *
     * @param Asset $asset
     *
     * @return \Illuminate\View\View
     */
    public function btnActionsForAsset(Asset $asset)
    {
        return view('viewers.meter.buttons.actions-asset', ['asset' => $asset, 'meter' => $this->entity]);
    }
}
