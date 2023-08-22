<?php

namespace App\Traits;

use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait AuditTrait
{
    use LogsActivity;

    protected $loggingColumns = null;

    protected $logName = null;

    protected $logDescription = null;

    public $incrementing = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->getLoggingColumns())
            ->useLogName($this->getLogName())
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = $this->getLogDescription() !== null ? $this->getLogDescription() : ucfirst($this->getTable()).' '.$eventName;
    }

    public function setLogDescription(string $description)
    {
        $this->logDescription = $description;
    }

    public function getLogDescription()
    {
        return $this->logDescription;
    }

    public function setLogName(string $name)
    {
        $this->logName = $name;
    }

    public function getLogName()
    {
        return $this->logName ?: ucfirst($this->getTable());
    }

    public function setLoggingColumns(string $name)
    {
        $this->loggingColumns = $name;
    }

    public function getLoggingColumns()
    {
        return $this->loggingColumns ?: $this->getFillable();
    }

    public function latestActivity()
    {
        return $this->activities()->latest()->first();
    }

    public function latestActivityUser()
    {
        $activity = $this->latestActivity();

        return $activity !== null && $activity->causer ? $activity->causer->first_name : null;
    }

    public function latestActivityUserwithTime()
    {
        if ($activity = $this->latestActivity()) {
            $user = $activity->causer;
            $user_name = $user ? $user->first_name : null;
            $activity_time = $activity->created_at->format('F j, Y h:i A');

            return 'Last updated by '.$user_name.' at '.$activity_time;
        }
    }
}
