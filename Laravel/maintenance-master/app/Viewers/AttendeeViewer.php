<?php

namespace App\Viewers;

class AttendeeViewer extends BaseViewer
{
    /**
     * Returns the attendees status view.
     *
     * @return \Illuminate\View\View
     */
    public function status()
    {
        return view('viewers.event.attendee.status', [
            'attendee' => $this->entity,
        ]);
    }

    /**
     * Returns the attendees action button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.event.attendee.buttons.actions', [
            'attendee' => $this->entity,
        ]);
    }
}
