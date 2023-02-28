<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterScope implements Scope
{
    protected $filterColumns = [];

    public function apply(Builder $builder, Model $model)
    {
        $targetColumnText = 'filterColumns';
        $columns = property_exists($model, $targetColumnText) ? $model->$targetColumnText : $this->$targetColumnText;

        if (request()->method() == "GET") {
            foreach ($columns as $column) {
                if ($$column = request($column)) {
                    if (!empty($$column) && $$column != 0) {
                        $builder->where(compact($column));
                    }
                }
            }
        }
    }
}
