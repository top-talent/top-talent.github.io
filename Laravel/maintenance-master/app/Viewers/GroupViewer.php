<?php

namespace App\Viewers;

class GroupViewer extends BaseViewer
{
    /**
     * Returns the groups profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('viewers.group.profile', ['group' => $this->entity]);
    }

    /**
     * Returns the groups users view.
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        return view('viewers.group.users', ['group' => $this->entity]);
    }

    /**
     * Returns the groups permissions view.
     *
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        return view('viewers.group.permissions', ['group' => $this->entity]);
    }

    /**
     * Returns the groups action buttons view.
     *
     * @return \Illuminate\View\View
     */
    public function btnActions()
    {
        return view('viewers.group.buttons.actions', ['group' => $this->entity]);
    }

    /**
     * Returns the groups edit button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnEdit()
    {
        return view('viewers.group.buttons.edit', ['group' => $this->entity]);
    }

    /**
     * Returns the groups delete button view.
     *
     * @return \Illuminate\View\View
     */
    public function btnDelete()
    {
        return view('viewers.group.buttons.delete', ['group' => $this->entity]);
    }
}
