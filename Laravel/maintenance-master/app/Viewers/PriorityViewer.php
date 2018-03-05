<?php

namespace App\Viewers;

class PriorityViewer extends BaseViewer
{
    /**
     * Returns the priority's actions button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.priority.buttons.actions', ['priority' => $this->entity]);
    }
}
