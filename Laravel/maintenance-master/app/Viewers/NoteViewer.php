<?php

namespace App\Viewers;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Viewer\AbstractViewer;

class NoteViewer extends AbstractViewer
{
    /**
     * Returns the noteable models actions button view.
     *
     * @param Model $noteable
     *
     * @return \Illuminate\View\View
     */
    public function btnNoteableActions(Model $noteable)
    {
        return view('viewers.noteable.buttons.actions', [
            'noteable' => $noteable,
        ]);
    }
}
