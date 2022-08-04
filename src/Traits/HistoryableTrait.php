<?php

namespace App\Traits;

use App\Events\HistoryEventObserver;

trait HistoryableTrait
{
    /**
     * @return void
     */
    public static function bootHistoryableTrait()
    {
        static::observe(new HistoryEventObserver());
    }

    /**
     * @return array|mixed|string[]
     */
    public function getExcludedColumns()
    {
        return !isset($this->excludedColumns)
            ? []
            : $this->excludedColumns;
    }

    /**
     * @return array|mixed|string[]
     */
    public function getExcludedEvents()
    {
        return !isset($this->excludedEvents)
            ? []
            : $this->excludedEvents;
    }
}
