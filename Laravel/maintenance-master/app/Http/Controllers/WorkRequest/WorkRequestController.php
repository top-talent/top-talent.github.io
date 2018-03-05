<?php

namespace App\Http\Controllers\WorkRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest as WorkHttpRequest;
use App\Processors\WorkRequest\WorkRequestProcessor;

class WorkRequestController extends Controller
{
    /**
     * @var WorkRequestProcessor
     */
    protected $processor;

    /**
     * @param WorkRequestProcessor $processor
     */
    public function __construct(WorkRequestProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays all work requests.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Displays the form to create a work request.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Processes creating a work request.
     *
     * @param WorkHttpRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkHttpRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created work request');

            return redirect()->route('maintenance.work-requests.index');
        } else {
            flash()->error('Error!', 'There was an issue creating a work request. Please try again.');

            return redirect()->route('maintenance.work-requests.create');
        }
    }

    /**
     * Displays a work request by the specified ID.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return $this->processor->show($id);
    }

    /**
     * Displays the form for editing the work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->processor->edit($id);
    }

    /**
     * Updates the specified work request.
     *
     * @param WorkHttpRequest $request
     * @param int|string      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkHttpRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully updated work request.');

            return redirect()->route('maintenance.work-requests.show', [$id]);
        } else {
            flash()->error('Error!', 'There was an issue updating this work request. Please try again.');

            return redirect()->route('maintenance.work-requests.edit', [$id]);
        }
    }

    /**
     * Deletes the specified work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted work request.');

            return redirect()->route('maintenance.work-requests.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this work request. Please try again.');

            return redirect()->route('maintenance.work-requests.show', [$id]);
        }
    }
}
