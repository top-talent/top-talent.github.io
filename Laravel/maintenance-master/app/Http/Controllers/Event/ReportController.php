<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Event\ReportRequest;
use App\Repositories\EventRepository;

class ReportController extends BaseController
{
    /**
     * @var EventRepository
     */
    protected $event;

    /**
     * Constructor.
     *
     * @param EventRepository $event
     */
    public function __construct(EventRepository $event)
    {
        $this->event = $event;
    }

    /**
     * Creates a new report on the specified event.
     *
     * @param ReportRequest $request
     * @param int|string    $eventId
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(ReportRequest $request, $eventId)
    {
        $report = $this->event->createReport($request, $eventId);

        if ($report) {
            $message = 'Successfully created event report.';

            return redirect()->route('maintenance.events.show', [$eventId, '#tab-report'])->withSuccess($message);
        } else {
            $message = 'There was an issue creating a report for this event. Please try again.';

            return redirect()->route('maintenance.events.show', [$eventId, '#tab-report'])->withErrors($message);
        }
    }

    public function edit($event_id, $report_id)
    {
    }

    public function update($event_id, $report_id)
    {
    }

    public function destroy($event_id, $report_id)
    {
    }
}
