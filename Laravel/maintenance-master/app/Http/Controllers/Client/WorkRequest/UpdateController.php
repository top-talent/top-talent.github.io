<?php

namespace App\Http\Controllers\Client\WorkRequest;

use App\Http\Controllers\Controller as BaseController;
use App\Services\UpdateService;
use App\Services\WorkRequestService;
use App\Validators\UpdateValidator;

class UpdateController extends BaseController
{
    /**
     * @var UpdateService
     */
    protected $update;

    /**
     * @var WorkRequestService
     */
    protected $workRequest;

    /**
     * @var UpdateValidator
     */
    protected $updateValidator;

    /**
     * @param UpdateService      $update
     * @param WorkRequestService $workRequest
     * @param UpdateValidator    $updateValidator
     */
    public function __construct(UpdateService $update, WorkRequestService $workRequest, UpdateValidator $updateValidator)
    {
        $this->update = $update;
        $this->workRequest = $workRequest;
        $this->updateValidator = $updateValidator;
    }

    /**
     * Creates a new work order customer update.
     *
     * @param int $workRequestId
     *
     * @return mixed
     */
    public function store($workRequestId)
    {
        if ($this->updateValidator->passes()) {
            $workRequest = $this->workRequest->find($workRequestId);

            $update = $this->update->setInput($this->inputAll())->create();

            $this->workRequest->saveUpdate($workRequest, $update);

            $this->message = 'Successfully added update';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.client.work-requests.show', [$workRequest->id]);
        } else {
            $this->errors = $this->updateValidator->getErrors();
            $this->redirect = route('maintenance.client.work-requests.show', [$workRequestId]);
        }

        return $this->response();
    }

    /**
     * Processes deleting a work order update.
     *
     * @param $workRequestId
     * @param $updateId
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy($workRequestId, $updateId)
    {
        $workRequest = $this->workRequest->find($workRequestId);

        if ($this->update->destroy($updateId)) {
            $this->message = 'Successfully deleted update';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.client.work-requests.show', [$workRequest->id]);
        } else {
            $this->message = 'There was an error trying to delete this update. Please try again.';
            $this->messageType = 'danger';
            $this->redirect = route('maintenance.client.work-requests.show', [$workRequest->id]);
        }

        return $this->response();
    }
}
