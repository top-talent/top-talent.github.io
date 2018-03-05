<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Event\Request;
use App\Repositories\EventRepository;

class Controller extends BaseController
{
    /**
     * @var EventRepository
     */
    protected $event;

    /**
     * @param EventRepository $event
     */
    public function __construct(EventRepository $event)
    {
        $this->event = $event;
    }

    /**
     * Displays all current events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Displays the form for creating a new event.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Creates a new event.
     *
     * @param Request $request
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(Request $request)
    {
        $event = $this->event->create($request);

        if ($event) {
            $message = 'Successfully created event.';

            return redirect()->route('maintenance.events.index')->withSuccess($message);
        } else {
            $message = 'There was an issue creating an event. Please try again.';

            return redirect()->route('maintenance.events.create')->withErrors($message);
        }
    }

    /**
     * Displays the specified event.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = $this->event->find($id);

        $apiObject = $this->event->findApiObject($event->api_id);

        if ($apiObject) {
            return view('events.show', compact('event', 'apiObject'));
        }

        abort(404);
    }

    /**
     * Displays the form for editing the specified event.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        $event = $this->event->find($id);

        $apiObject = $this->event->findApiObject($event->api_id);

        if ($apiObject) {
            return view('events.edit', compact('event', 'apiObject'));
        }

        abort(404);
    }

    /**
     * Updates an event.
     *
     * @param Request    $request
     * @param int|string $id
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function update(Request $request, $id)
    {
        $event = $this->event->update($request, $id);

        if ($event) {
            $message = 'Successfully updated event.';

            return redirect()->route('maintenance.events.show', [$event->id])->withSuccess($message);
        } else {
            $message = 'There was an issue updating this event. Please try again.';

            return redirect()->route('maintenance.events.create')->withErrors($message);
        }
    }

    /**
     * Deletes the specified event.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->event->delete($id)) {
            $message = 'Successfully deleted event';

            return redirect()->route('maintenance.events.index')->withSuccess($message);
        } else {
            $message = 'There was an error trying to delete this event. Please try again.';

            return redirect()->route('maintenance.events.show', [$id])->withErrors($message);
        }
    }
}
