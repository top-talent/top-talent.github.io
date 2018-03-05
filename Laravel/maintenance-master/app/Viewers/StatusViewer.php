<?php

namespace App\Viewers;

class StatusViewer extends BaseViewer
{
    /**
     * Returns the status' actions button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.status.buttons.actions', ['status' => $this->entity])->render();
    }
}
