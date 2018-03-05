<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Event\Request as EventRequest;
use App\Repositories\EventRepository;

abstract class EventableController extends BaseController
{
    /**
     * @var EventRepository
     */
    protected $event;

    /**
     * The eventable's routes.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Constructor.
     *
     * @param EventRepository $event
     */
    public function __construct(EventRepository $event)
    {
        $this->event = $event->setCalendarId($this->getEventableCalendarId());
    }

    /**
     * Displays all of the specified eventables events.
     *
     * @param int|string $resourceId
     *
     * @return \Illuminate\View\View
     */
    public function index($resourceId)
    {
        $routes = $this->routes;

        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        return view('events.eventables.index', compact('eventable', 'routes'));
    }

    /**
     * Displays the form for creating a new event.
     *
     * @param int|string $resourceId
     *
     * @return \Illuminate\View\View
     */
    public function create($resourceId)
    {
        $routes = $this->routes;

        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        return view('events.eventables.create', compact('eventable', 'routes'));
    }

    /**
     * Creates a new event and attaches it to the specified eventable.
     *
     * @param EventRequest $request
     * @param int|string   $resourceId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EventRequest $request, $resourceId)
    {
        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        $event = $this->event->create($request);

        if ($event && method_exists($eventable, 'events')) {
            $eventable->events()->attach($event->id);

            $message = 'Successfully created event.';

            return redirect()->route($this->routes['index'], $eventable->id)->withSuccess($message);
        } else {
            $message = 'There was an issue creating an event. Please try again.';

            return redirect()->route($this->routes['create'])->withErrors($message);
        }
    }

    /**
     * Displays the specified event attached to the specified eventable.
     *
     * @param int|string $resourceId
     * @param int|string $eventId
     *
     * @return \Illuminate\View\View
     */
    public function show($resourceId, $eventId)
    {
        $routes = $this->routes;

        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        if (method_exists($eventable, 'events')) {
            $event = $eventable->events()->find($eventId);

            if ($event) {
                $apiObject = $this->event->findApiObject($event->api_id);

                return view('events.eventables.show', compact('routes', 'eventable', 'event', 'apiObject'));
            }
        }

        abort(404);
    }

    /**
     * @param int|string $resourceId
     * @param int|string $eventId
     *
     * @return mixed
     */
    public function edit($resourceId, $eventId)
    {
        $routes = $this->routes;

        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        if (method_exists($eventable, 'events')) {
            $event = $eventable->events()->find($eventId);

            if ($event) {
                $apiObject = $this->event->findApiObject($event->api_id);

                return view('events.eventables.edit', compact('routes', 'eventable', 'event', 'apiObject'));
            }
        }

        abort(404);
    }

    /**
     * Updates the specified event attached to the specified eventable.
     *
     * @param EventRequest $request
     * @param int|string   $resourceId
     * @param int|string   $eventId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EventRequest $request, $resourceId, $eventId)
    {
        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        $event = $this->event->update($request, $eventId);

        if ($event) {
            $message = 'Successfully updated event.';

            return redirect()->route($this->routes['show'], [$eventable->id, $event->id])->withSuccess($message);
        } else {
            $message = 'There was an issue updating this event. Please try again.';

            return redirect()->route($this->routes['edit'], [$eventable->id])->withErrors($message);
        }
    }

    /**
     * Deletes the specified event attached to the specified eventable.
     *
     * @param int|string $resourceId
     * @param int|string $eventId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($resourceId, $eventId)
    {
        $eventable = $this->getEventableRepository()->model()->findOrFail($resourceId);

        if (method_exists($eventable, 'events')) {
            $event = $eventable->events()->find($eventId);

            if ($event && $this->event->delete($event->id)) {
                $message = 'Successfully deleted event.';

                return redirect()->route($this->routes['index'], $eventable->id)->withSuccess($message);
            } else {
                $message = 'There was an issue deleting this event. Please try again.';

                return redirect()->route($this->routes['show'], $eventable->id, $event->id)->withErrors($message);
            }
        }

        abort(404);
    }

    /**
     * Retrieves the eventable respository.
     *
     * @return \App\Repositories\Repository
     */
    abstract protected function getEventableRepository();

    /**
     * @return string
     */
    abstract protected function getEventableCalendarId();
}
