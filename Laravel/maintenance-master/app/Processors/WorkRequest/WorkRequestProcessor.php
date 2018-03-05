<?php

namespace App\Processors\WorkRequest;

use App\Http\Presenters\WorkRequest\WorkRequestPresenter;
use App\Http\Requests\WorkRequest as WorkHttpRequest;
use App\Jobs\WorkOrder\StoreFromWorkRequest;
use App\Jobs\WorkRequest\Store;
use App\Jobs\WorkRequest\Update;
use App\Models\WorkRequest;
use App\Processors\Processor;

class WorkRequestProcessor extends Processor
{
    /**
     * @var WorkRequest
     */
    protected $workRequest;

    /**
     * @var WorkRequestPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkRequest          $workRequest
     * @param WorkRequestPresenter $presenter
     */
    public function __construct(WorkRequest $workRequest, WorkRequestPresenter $presenter)
    {
        $this->workRequest = $workRequest;
        $this->presenter = $presenter;
    }

    /**
     * Displays all work requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $workRequests = $this->presenter->table($this->workRequest);

        $navbar = $this->presenter->navbar();

        return view('work-requests.index', compact('workRequests', 'navbar'));
    }

    /**
     * Displays the form for creating a new work request.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->workRequest);

        return view('work-requests.create', compact('form'));
    }

    /**
     * Creates a work request.
     *
     * @param WorkHttpRequest $request
     *
     * @return bool
     */
    public function store(WorkHttpRequest $request)
    {
        $workRequest = $this->workRequest->newInstance();

        if ($this->dispatch(new Store($request, $workRequest))) {
            $this->dispatch(new StoreFromWorkRequest($workRequest));

            return true;
        }

        return false;
    }

    /**
     * Displays the specified work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $workRequest = $this->workRequest->findOrFail($id);

        return view('work-requests.show', compact('workRequest'));
    }

    /**
     * Displays the form for editing the specified work request.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $workRequest = $this->workRequest->findOrFail($id);

        $form = $this->presenter->form($workRequest);

        return view('work-requests.edit', compact('form'));
    }

    /**
     * Updates the specified work request.
     *
     * @param WorkHttpRequest $request
     * @param int|string      $id
     *
     * @return bool
     */
    public function update(WorkHttpRequest $request, $id)
    {
        $workRequest = $this->workRequest->findOrFail($id);

        return $this->dispatch(new Update($request, $workRequest));
    }

    /**
     * Deletes the specified work request.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $workRequest = $this->workRequest->findOrFail($id);

        return $workRequest->delete();
    }
}
