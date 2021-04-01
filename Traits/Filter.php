<?php

namespace HermesHerrera\Traits;

use Illuminate\Pipeline\Pipeline;

trait Filter
{
    public function scopeFilter($builder)
    {
        app(Pipeline::class)
            ->send($builder)
            ->through(
                $this->getFilters()
            )
            ->thenReturn();
    }
}
