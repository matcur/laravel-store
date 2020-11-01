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

    public function render(Model $model, bool $darkBg)
    {
        $content = $model->{$this->name};

        if ($this->callback !== null)
            $content = $this->callback->bindTo($model)();

        $this->openTag($darkBg);

        echo $content;

        echo '</th>';
    }

    //Использует $callback для вывода значения ячейки колонны
    public function displayAs(Closure $callback)
    {
        $this->callback = $callback;
    }

    private function openTag(bool $darkBg)
    {
        echo $darkBg? '<th class="dark-bg">': '<th class="light-bg">';
    }
}
