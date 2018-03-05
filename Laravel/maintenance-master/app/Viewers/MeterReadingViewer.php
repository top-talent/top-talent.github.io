<?php

namespace App\Viewers;

use App\Models\Asset;

class MeterReadingViewer extends BaseViewer
{
    /**
     * Returns the meter readings action
     * buttons view for the specified asset.
     *
     * @param Asset $asset
     *
     * @return \Illuminate\View\View
     */
    public function btnActionsForAsset(Asset $asset)
    {
        return view('viewers.meter.reading.buttons.actions', [
            'asset'   => $asset,
            'reading' => $this->entity,
        ]);
    }
}
