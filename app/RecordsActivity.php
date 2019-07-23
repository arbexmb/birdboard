<?php

namespace App;

trait RecordsActivity
{
    public $oldAttributes = [];

    public static function bootRecordsActivity()
    {
        foreach(self::recordableEvents() as $event) {
            static::$event(function ($model) use($event) {
                $model->recordActivity("{$event}_" . strtolower(class_basename($model)));
            });
        }

        if($event === 'updated') {
            static::updating(function ($model) {
                $model->oldAttributes = $model->getOriginal();
            });
        }
    }

    protected static function recordableEvents()
    {
        if(isset(static::$recordableEvents))
            return static::$recordableEvents;
        
        return ['created', 'updated'];
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject')->latest();
    }

    protected function activityChanges()
    {
        if($this->wasChanged()) {
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }
    }

    public function recordActivity($description)
    {
        dd($this->owner->id);
        $this->activity()->create([
            'user_id' => ($this->project ?? $this)->owner->id,
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
            'changes' => $this->activityChanges(),
            'description' => $description,
        ]);
    }
}