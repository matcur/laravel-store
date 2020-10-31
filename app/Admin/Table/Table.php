<?php

namespace App\Admin\Table;

use App\Admin\Contracts\PageElementContract;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Table implements PageElementContract
{
    private Collection $columns;
    private Collection $columnNames;
    private LengthAwarePaginator $modelPaginate;

    public function __construct(LengthAwarePaginator $modelPaginate)
    {
        $this->columns = new Collection();
        $this->columnNames = new Collection();
        $this->modelPaginate = $modelPaginate;
    }

    public function addColumn(string $dbColumnName, string $displayName = null)
    {
        $this->columnNames[] = $displayName ?? $dbColumnName;

        return $this->columns[] = new Column($dbColumnName);
    }

    public function render()
    {
        echo '<table>';

        $this->renderHead();
        $this->renderBody();

        echo '</table>';

        $this->renderLinks();
    }

    private function renderHead()
    {
        echo '<thead>';
        echo '<tr>';

        echo $this->columnNames->map(function ($cN) {
            return "<th>$cN</th>";
        })->implode('');

        echo '</tr>';
        echo '</thead>';
    }

    private function renderBody()
    {
        echo '<tbody>';

        $this->modelPaginate->each(function(Model $model) {
            $this->renderRow($model);
        });

        echo '</tbody>';
    }

    private function renderRow(Model $model)
    {
        echo '<tr>';

        $this->columns->each(function(Column $column) use ($model) {
            $column->renderRow($model);
        });

        echo '</tr>';
    }

    private function renderLinks()
    {
        echo $this->modelPaginate->links()->toHtml();
    }
}
