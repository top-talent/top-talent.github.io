<?php

namespace App\Http\Presenters\WorkOrder;

use App\Http\Presenters\Presenter;
use App\Models\Comment;
use App\Models\WorkOrder;
use Orchestra\Contracts\Html\Form\Fieldset;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;

class WorkOrderCommentPresenter extends Presenter
{
    /**
     * Returns a new form for the specified comment.
     *
     * @param WorkOrder $workOrder
     * @param Comment   $comment
     *
     * @return \Orchestra\Contracts\Html\Builder
     */
    public function form(WorkOrder $workOrder, Comment $comment)
    {
        return $this->form->of('work-orders.comments', function (FormGrid $form) use ($workOrder, $comment) {
            if ($comment->exists) {
                $method = 'PATCH';
                $url = route('work-orders.comments.update', [$workOrder->getKey(), $comment->getKey()]);

                $form->submit = 'Save';
            } else {
                $method = 'POST';
                $url = route('work-orders.comments.store', [$workOrder->getKey()]);

                $form->submit = 'Create';
            }

            $form->attributes(compact('method', 'url'));

            $form->with($comment);

            $form->fieldset(function (Fieldset $fieldset) {

                $fieldset->control('input:text', 'content');

            });
        });
    }
}
