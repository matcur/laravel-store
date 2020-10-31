<?php

namespace App\Admin\Table;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Row
{
    private Model $model;
    private Collection $columns;

    public function __construct(Collection $columns, Model $model)
    {
        $this->columns = $columns;
        $this->model = $model;
    }

    public function render(int $rowNumber, bool $darkBg = false)
    {
        $this->openTag($darkBg);

        $this->columns->each(function (Column $c, $key) use ($rowNumber) {
            $darkBg = ($rowNumber + $key) % 2 == 0;
            $c->render($this->model, $darkBg);
        });

        echo '</tr>';
    }

    private function openTag(bool $darkBg)
    {
        echo $darkBg? '<tr class="dark-bg">': '<tr class="light-bg">';
    }
}
