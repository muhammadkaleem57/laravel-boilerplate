<?php


namespace App\Concerns;

trait Logs
{
    public static function __onCreating($model)
    {
        (new self())->onCreating($model);
    }

    public function onCreating($model)
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $model->added_by = $userId;
            $model->last_updated_by = $userId;
        }
    }

    public static function __onUpdating($model)
    {
        (new self())->onUpdating($model);
    }

    public function onUpdating($model)
    {
        if (auth()->check() && $model->isDirty())
            $model->last_updated_by = auth()->id();
    }
}
