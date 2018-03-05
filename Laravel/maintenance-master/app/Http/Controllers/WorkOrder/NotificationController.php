<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller as BaseController;
use App\Services\WorkOrder\NotificationService;
use App\Services\WorkOrder\WorkOrderService;
use App\Validators\WorkOrder\NotificationValidator;

class NotificationController extends BaseController
{
    /**
     * @var NotificationService
     */
    protected $workOrderNotification;

    /**
     * @var NotificationValidator
     */
    protected $workOrderNotificationValidator;

    /**
     * @var WorkOrderService
     */
    protected $workOrder;

    /**
     * Constructor.
     *
     * @param WorkOrderService      $workOrder
     * @param NotificationService   $workOrderNotification
     * @param NotificationValidator $workOrderNotificationValidator
     */
    public function __construct(
        WorkOrderService $workOrder,
        NotificationService $workOrderNotification,
        NotificationValidator $workOrderNotificationValidator
    ) {
        $this->workOrderNotification = $workOrderNotification;
        $this->workOrderNotificationValidator = $workOrderNotificationValidator;
        $this->workOrder = $workOrder;
    }

    /**
     * Creates a new notification for the specified work order.
     *
     * @param string|int $workOrderId
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store($workOrderId)
    {
        if ($this->workOrderNotificationValidator->passes()) {
            $workOrder = $this->workOrder->find($workOrderId);

            $data = $this->inputAll();
            $data['work_order_id'] = $workOrder->id;

            $this->workOrderNotification->setInput($data)->create();

            $this->message = 'Successfully updated notifications';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.work-orders.show', [$workOrder->id]);
        } else {
            $this->errors = $this->workOrderNotificationValidator->getErrors();
            $this->redirect = route('maintenance.work-orders.show', [$workOrderId]);
        }

        return $this->response();
    }

    /**
     * Updates the specified notification for the specified work order.
     *
     * @param string|int $workOrderId
     * @param string|int $notificationId
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update($workOrderId, $notificationId)
    {
        if ($this->workOrderNotificationValidator->passes()) {
            $workOrder = $this->workOrder->find($workOrderId);

            $notifications = $this->workOrderNotification->find($notificationId);

            $data = $this->inputAll();
            $data['work_order_id'] = $workOrder->id;

            $this->workOrderNotification->setInput($data)->update($notifications->id);

            $this->message = 'Successfully updated notifications';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.work-orders.show', [$workOrder->id]);
        } else {
            $this->errors = $this->workOrderNotificationValidator->getErrors();
            $this->redirect = route('maintenance.work-orders.show', [$workOrderId]);
        }

        return $this->response();
    }
}
