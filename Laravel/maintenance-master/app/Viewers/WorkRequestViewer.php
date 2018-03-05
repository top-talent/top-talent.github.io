<?php

namespace App\Viewers;

class WorkRequestViewer extends BaseViewer
{
    /**
     * Returns the work orders profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('viewers.work-request.profile', ['workRequest' => $this->entity]);
    }

    /**
     * Returns the work orders updates view.
     *
     * @return \Illuminate\View\View
     */
    public function updates()
    {
        return view('viewers.work-request.updates', ['workRequest' => $this->entity]);
    }

    /**
     * Returns the work order client updates view.
     *
     * @return \Illuminate\View\View
     */
    public function clientUpdates()
    {
        return view('viewers.work-request.client-updates', ['workRequest' => $this->entity]);
    }

    /**
     * Returns the work orders action buttons view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.work-request.buttons.actions', ['workRequest' => $this->entity]);
    }
}
