<?php

namespace App\Viewers;

use Stevebauman\Viewer\AbstractViewer;

class BaseViewer extends AbstractViewer
{
    /**
     * Returns the records history view.
     *
     * @return \Illuminate\View\View
     */
    public function history()
    {
        return view('partials.history-table', ['record' => $this->entity]);
    }
}
