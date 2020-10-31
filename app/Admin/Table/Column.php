<?php

namespace App\Admin\Table;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Column
{
    private string $name;
    private ?Closure $callback;

    public function __construct(string $name, ?Closure $callback = null)
    {
        $this->name = $name;
        $this->callback = $callback;
    }

    public function renderRow(Model $model)
    {
        $content = $model->{$this->name};

        if ($this->callback !== null)
            $content = $this->callback->bindTo($model)();

        echo "<th>$content</th>";
    }

    public function setCallback(Closure $callback)
    {
        $this->callback = $callback;
    }
}
