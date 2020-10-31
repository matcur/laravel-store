<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Table\Table;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class AdminController extends Controller
{
    protected Table $table;

    protected function tableFrom(Model $model, $perPage = 10)
    {
        return new Table($model->paginate($perPage));
    }
}
