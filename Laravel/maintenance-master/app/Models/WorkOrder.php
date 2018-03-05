<?php

namespace App\Models;

use App\Models\Traits\HasCategoryTrait;
use App\Models\Traits\HasEventsTrait;
use App\Models\Traits\HasLocationTrait;
use App\Models\Traits\HasNotesTrait;
use App\Models\Traits\HasUserTrait;
use App\Viewers\WorkOrder\WorkOrderViewer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchestra\Support\Facades\HTML;

class WorkOrder extends Model
{
    use SoftDeletes, HasNotesTrait, HasLocationTrait, HasUserTrait, HasEventsTrait, HasCategoryTrait;

    /**
     * The work orders table.
     *
     * @var string
     */
    protected $table = 'work_orders';

    /**
     * The work orders viewer.
     *
     * @var string
     */
    protected $viewer = WorkOrderViewer::class;

    /**
     * The work orders fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'location_id',
        'category_id',
        'request_id',
        'status_id',
        'priority_id',
        'subject',
        'description',
        'started_at',
        'completed_at',
    ];

    /**
     * The columns to keep revisions of.
     *
     * @var array
     */
    protected $revisionColumns = [
        'location_id',
        'category_id',
        'status_id',
        'priority_id',
        'subject',
        'description',
        'started_at',
        'completed_at',
    ];

    /**
     * The work orders revisionable formatted field names.
     *
     * @var array
     */
    protected $revisionColumnsFormatted = [
        'location_id'  => 'Location',
        'category_id'  => 'Work Order Category',
        'status_id'    => 'Status',
        'priority_id'  => 'Priority',
        'subject'      => 'Subject',
        'description'  => 'Description',
        'started_at'   => 'Started At',
        'completed_at' => 'Completed At',
    ];

    /**
     * The revision column means attributes.
     *
     * @var array
     */
    protected $revisionColumnsMean = [
        'location_id'   => 'revised_location',
        'category_id'   => 'revised_category',
        'status_id'     => 'revised_status',
        'priority_id'   => 'revised_priority',
    ];

    /**
     * The belongsTo work request relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()
    {
        return $this->belongsTo(WorkRequest::class, 'request_id');
    }

    /**
     * The belongsToMany comments relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'work_order_comments', 'work_order_id', 'comment_id');
    }

    /**
     * The hasOne status relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    /**
     * The hasOne priority relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function priority()
    {
        return $this->hasOne(Priority::class, 'id', 'priority_id');
    }

    /**
     * The belongsToMany assets relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'work_order_assets', 'work_order_id', 'asset_id');
    }

    /**
     * The hasOne report relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function report()
    {
        return $this->hasOne(WorkOrderReport::class, 'work_order_id');
    }

    /**
     * The hasMany assignments relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany(WorkOrderAssignment::class, 'work_order_id', 'id');
    }

    /**
     * The belongsToMany attachments relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class, 'work_order_attachments', 'work_order_id', 'attachment_id');
    }

    /**
     * The belongsToMany inventory parts relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parts()
    {
        return $this->belongsToMany(InventoryStock::class, 'work_order_parts', 'work_order_id', 'stock_id')->withTimestamps()->withPivot('quantity');
    }

    /**
     * The hasMany sessions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany(WorkOrderSession::class, 'work_order_id')->latest();
    }

    /**
     * The hasMany notifiable users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifiableUsers()
    {
        return $this->hasMany(WorkOrderNotification::class, 'work_order_id', 'id');
    }

    /**
     * Retrieves the revised status attribute.
     *
     * @param int|string $id
     *
     * @return null|string
     */
    public function getRevisedStatusAttribute($id)
    {
        if ($id) {
            $status = $this->status()->find($id);

            if ($status instanceof Status) {
                return $status->getLabel();
            }
        }

        return;
    }

    /**
     * Retrieves the revised priority attribute.
     *
     * @param int|string $id
     *
     * @return null|string
     */
    public function getRevisedPriorityAttribute($id)
    {
        if ($id) {
            $priority = $this->priority()->find($id);

            if ($priority instanceof Priority) {
                return $priority->getLabel();
            }
        }

        return;
    }

    /**
     * Closes all sessions on the current work order.
     *
     * @return array
     */
    public function closeSessions()
    {
        $closed = [];

        foreach ($this->sessions as $session) {
            if ($session instanceof WorkOrderSession && is_null($session->out)) {
                $session->out = $this->freshTimestamp();

                if ($session->save()) {
                    $closed[] = $session;
                }
            }
        }

        return $closed;
    }

    /**
     * Checks if the current work order is complete by checking if a report
     * has been filled out.
     *
     * @return bool
     */
    public function isComplete()
    {
        return $this->report ? true : false;
    }

    /**
     * Checks if the current work has workers assigned to it.
     *
     * @return bool
     */
    public function hasWorkersAssigned()
    {
        return $this->assignments->count() > 0;
    }

    /**
     * Checks if the user is currently checked into the current work order.
     *
     * @return bool
     */
    public function userCheckedIn()
    {
        $session = $this->getCurrentSession();

        if ($session instanceof WorkOrderSession) {
            return $session->in && is_null($session->out);
        }

        return false;
    }

    /**
     * Returns the current users work order session record.
     *
     * @return WorkOrderSession|null
     */
    public function getCurrentSession()
    {
        return $this->sessions()->where('user_id', auth()->id())->first();
    }

    /**
     * Alias for getUserNotifications().
     *
     * @return object
     */
    public function getNotifyAttribute()
    {
        return $this->getUserNotifications();
    }

    /**
     * Returns the current users work order notifications.
     *
     * @return object
     */
    public function getUserNotifications()
    {
        return $this->notifiableUsers()->where('user_id', auth()->id())->first();
    }

    /**
     * Returns the current work order
     * sessions for the specified user.
     *
     * @param int|string $userId
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserSessions($userId)
    {
        return $this->sessions()->where('user_id', $userId)->latest()->get();
    }

    /**
     * Returns the specified users last session.
     *
     * @param int|string $userId
     *
     * @return WorkOrderSession|null
     */
    public function getLastUsersSession($userId)
    {
        return $this->sessions()->where('user_id', $userId)->latest()->firstOrFail();
    }

    /**
     * Retrieves all of the users work order
     * sessions grouped by each user.
     *
     * @return Builder
     */
    public function getUniqueSessions()
    {
        return $this->sessions()->unique();
    }

    /**
     * Returns an HTML label for the work orders started at date.
     *
     * @return string
     */
    public function getStartedAtLabel()
    {
        if ($this->started_at) {
            $class = 'label label-success';
            $icon = 'fa fa-check';
            $message = $this->started_at;
        } else {
            $class = 'label label-danger';
            $icon = 'fa fa-times';
            $message = 'Has not been started.';
        }

        $icon = HTML::create('i', '', ['class' => $icon]);

        return HTML::raw("<span class='$class'>$icon $message</span>");
    }

    /**
     * Returns an HTML label for the work orders completed at date.
     *
     * @return string
     */
    public function getCompletedAtLabel()
    {
        if ($this->isComplete()) {
            $class = 'label label-success';
            $icon = 'fa fa-check';
            $message = $this->completed_at;
        } else {
            $class = 'label label-danger';
            $icon = 'fa fa-times';
            $message = 'No report has been created.';
        }

        $icon = HTML::create('i', '', ['class' => $icon]);

        return HTML::raw("<span class='$class'>$icon $message</span>");
    }

    /**
     * Set the default work order category id to null if the given value is empty.
     *
     * @param int|string $value
     */
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = $value ? $value : null;
    }

    /**
     * Set the default location id to null if the given value is empty.
     *
     * @param int|string $value
     */
    public function setLocationIdAttribute($value)
    {
        $this->attributes['location_id'] = $value ? $value : null;
    }

    /**
     * Completes the work order by saving the completed at timestamp to now.
     *
     * @param int|string $statusId
     *
     * @return $this|bool
     */
    public function complete($statusId)
    {
        if (is_null($this->started_at)) {
            $this->started_at = $this->freshTimestamp();
        }

        $this->completed_at = $this->freshTimestamp();
        $this->status_id = $statusId;

        return $this->save();
    }
}
