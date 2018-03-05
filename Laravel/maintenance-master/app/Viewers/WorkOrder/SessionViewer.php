<?php

namespace App\Viewers\WorkOrder;

use App\Viewers\BaseViewer;

class SessionViewer extends BaseViewer
{
    /**
     * Displays the total session hours.
     *
     * @return \Illuminate\View\View
     */
    public function totalHours()
    {
        return view('viewers.work-order.session.total-hours', [
            'totalHours' => $this->entity->total_hours,
        ]);
    }

    /**
     * Displays the session out label.
     *
     * @return \Illuminate\View\View
     */
    public function lblOut()
    {
        return view('viewers.work-order.session.labels.out', ['out' => $this->entity->out])->render();
    }
}
