<?php

namespace App\Viewers;

use App\Models\Asset;
use App\Models\WorkOrder;

class AttachmentViewer extends BaseViewer
{
    /**
     * Returns the attachments HTML image tag view.
     *
     * @return \Illuminate\View\View
     */
    public function tagImage()
    {
        return view('viewers.attachments.tags.image', [
            'image' => $this->entity,
        ]);
    }

    /**
     * Returns the attachments HTML image thumbnail tag view.
     *
     * @return \Illuminate\View\View
     */
    public function tagImageThumbnail()
    {
        return view('viewers.attachments.tags.image-thumbnail', [
            'image' => $this->entity,
        ]);
    }

    /**
     * Returns the attachment actions button
     * view for the specified work order.
     *
     * @param WorkOrder $workOrder
     *
     * @return \Illuminate\View\View
     */
    public function btnActionsForWorkOrderAttachment(WorkOrder $workOrder)
    {
        return view('viewers.attachments.buttons.actions-work-order-attachment', [
            'workOrder'  => $workOrder,
            'attachment' => $this->entity,
        ]);
    }

    /**
     * Returns the attachment actions button
     * view for the specified asset manual.
     *
     * @param Asset $asset
     *
     * @return \Illuminate\View\View
     */
    public function btnActionsForAssetManual(Asset $asset)
    {
        return view('viewers.attachments.buttons.actions-asset-manual', [
            'asset'  => $asset,
            'manual' => $this->entity,
        ]);
    }

    /**
     * Returns the attachment actions button
     * view for the specified asset image.
     *
     * @param Asset $asset
     *
     * @return \Illuminate\View\View
     */
    public function btnActionsForAssetImage(Asset $asset)
    {
        return view('viewers.attachments.buttons.actions-asset-image', [
            'asset' => $asset,
            'image' => $this->entity,
        ]);
    }
}
