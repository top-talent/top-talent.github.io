<?php

namespace App\Viewers;

class AssetViewer extends BaseViewer
{
    /**
     * Returns the assets profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('viewers.asset.profile', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets slideshow view.
     *
     * @return \Illuminate\View\View
     */
    public function slideshow()
    {
        return view('viewers.asset.slideshow', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets meters view.
     *
     * @return \Illuminate\View\View
     */
    public function meters()
    {
        return view('viewers.asset.meters', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets calendar view.
     *
     * @return \Illuminate\View\View
     */
    public function calendar()
    {
        return view('viewers.asset.calendar', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets images view.
     *
     * @return \Illuminate\View\View
     */
    public function images()
    {
        return view('viewers.asset.images', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets manuals view.
     *
     * @return \Illuminate\View\View
     */
    public function manuals()
    {
        return view('viewers.asset.manuals', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets work orders view.
     *
     * @return \Illuminate\View\View
     */
    public function workOrders()
    {
        return view('viewers.asset.work-orders', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets events button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnEvents()
    {
        return view('viewers.asset.buttons.events', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets add images button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnAddImages()
    {
        return view('viewers.asset.buttons.add-images', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets view images button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnImages()
    {
        return view('viewers.asset.buttons.images', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets add manuals button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnManuals()
    {
        return view('viewers.asset.buttons.manuals', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets add meter button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnAddMeter()
    {
        return view('viewers.asset.buttons.add-meter', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets edit button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnEdit()
    {
        return view('viewers.asset.buttons.edit', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets delete button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnDelete()
    {
        return view('viewers.asset.buttons.delete', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets restore button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnRestore()
    {
        return view('viewers.asset.buttons.restore', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets actions button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.asset.buttons.actions', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets archive button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActionsArchive()
    {
        return view('viewers.asset.buttons.actions-archived', ['asset' => $this->entity]);
    }

    /**
     * Returns the assets event tag button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnEventTag()
    {
        return view('viewers.asset.buttons.event-tag', [
            'asset' => $this->entity,
        ]);
    }

    /**
     * Returns the assets work orders button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnWorkOrders()
    {
        return view('viewers.asset.buttons.work-orders', [
            'asset' => $this->entity,
        ]);
    }
}
