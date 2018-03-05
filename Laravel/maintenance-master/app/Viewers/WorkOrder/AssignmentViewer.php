<?php

namespace App\Viewers\WorkOrder;

use App\Viewers\BaseViewer;

class AssignmentViewer extends BaseViewer
{
    public function btnRemove()
    {
        return view('viewers.work-order.assignment.buttons.remove', ['assignment' => $this->entity]);
    }
}
