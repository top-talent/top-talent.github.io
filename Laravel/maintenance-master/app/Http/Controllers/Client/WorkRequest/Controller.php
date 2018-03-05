<?php

namespace App\Http\Controllers\Client\WorkRequest;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\WorkRequest;
use App\Repositories\Client\WorkRequestRepository;

class Controller extends BaseController
{
    /**
     * @var WorkRequestRepository
     */
    protected $workRequest;

    /**
     * Constructor.
     *
     * @param WorkRequestRepository $workRequest
     */
    public function __construct(WorkRequestRepository $workRequest)
    {
        $this->workRequest = $workRequest;
    }

    /**
     * Displays all of the users work requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('client.work-requests.index');
    }

    /**
     * Displays the form to create a work request.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('client.work-requests.create');
    }

    /**
     * Creates a work request.
     *
     * @param WorkRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkRequest $request)
    {
        $workRequest = $this->workRequest->create($request);

        if ($workRequest) {
            $message = 'Successfully created work request. You will receive a response shortly.';

            return redirect()->route('maintenance.client.work-requests.index')->withSuccess($message);
        } else {
            $message = 'There was an issue creating a work request. Please try again.';

            return redirect()->route('maintenance.client.work-requests.create')->withErrors($message);
        }
    }

    /**
     * Displays the users specified work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $workRequest = $this->workRequest->model()->findOrFail($id);

        return view('client.work-requests.show', compact('workRequest'));
    }

    /**
     * Displays a users work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $workRequest = $this->workRequest->model()->findOrFail($id);

        return view('client.work-requests.edit', compact('workRequest'));
    }

    /**
     * Updates a users work request.
     *
     * @param WorkRequest $request
     * @param int|string  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkRequest $request, $id)
    {
        $workRequest = $this->workRequest->update($request, $id);

        if ($workRequest) {
            $message = 'Successfully updated work request.';

            return redirect()->route('maintenance.client.work-requests.show', [$workRequest->id])->withSuccess($message);
        } else {
            $message = 'There was an issue updating your work request. Please try again.';

            return redirect()->route('maintenance.client.work-requests.edit', [$id])->withErrors($message);
        }
    }

    /**
     * Deletes a users work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $workRequest = $this->workRequest->model()->findOrFail($id);

        if ($workRequest->delete()) {
            $message = 'Successfully deleted work request.';

            return redirect()->route('maintenance.client.work-requests.index')->withSuccess($message);
        } else {
            $message = 'There was an issue deleting this work request. Please try again.';

            return redirect()->route('maintenance.client.work-requests.show', [$id])->withErrors($message);
        }
    }
}
