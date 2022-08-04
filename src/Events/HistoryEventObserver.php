<?php

namespace App\Events;

use App\Exceptions\HistoryException;
use App\Models\History;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class HistoryEventObserver
{
    /**
     * @param Model $model
     * @return bool
     */
    public function created(Model $model)
    {
        if (!in_array('create', $model->getExcludedEvents())) {
            $this->saveHistory('created', $model);
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function updated(Model $model)
    {
        if (!in_array('update', $model->getExcludedEvents())) {
            if ($model->getChanges()) {
                $this->saveHistory('updated', $model);
            }
        }

        return true;
    }

    /**
     * @param Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        if (!in_array('delete', $model->getExcludedEvents())) {
            $this->saveHistory('deleted', $model);
        }
    }

    /**
     * @param $event
     * @param $model
     * @return void
     */
    private function saveHistory($event, $model)
    {
        try {
            $dirty = $model->getDirty();

            $oldValues = [];
            $newValues = [];
            $columns = [];

            $attributes = $model->getExcludedColumns();

            foreach ($dirty as $column => $value) {
                if (!in_array($column, $attributes)) {
                    $oldValues[] = [$column => $model->getOriginal($column)];
                    $newValues[] = [$column => $value];
                    $columns[] = [$column];
                }
            }
            DB::beginTransaction();
            $revision = array(
                'table' => $model->getTable(),
                'model' => $model->getMorphClass(),
                'model_id' => $model->getKey(),
                'column' => ($event != 'deleted') ? json_encode($columns, JSON_UNESCAPED_UNICODE) : null,
                'action' => $event,
                'old_value' => ($event == 'updated') ? json_encode($oldValues, JSON_UNESCAPED_UNICODE) : null,
                'new_value' => ($event != 'deleted') ? json_encode($newValues, JSON_UNESCAPED_UNICODE) : null,
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'ip_address' => Request::ip(),
            );

            History::create($revision);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new HistoryException($exception);
        }
    }
}
