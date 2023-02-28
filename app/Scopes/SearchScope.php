<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope
{
    protected $searchColumns = [];

    public function apply(Builder $builder, Model $model)
    {
        if ($search = request('search')) {

            $targetColumnText = 'searchColumns';
            $columns = property_exists($model, $targetColumnText) ? $model->$targetColumnText : $this->$targetColumnText;

            foreach ($columns as $index => $column) {
                $arr = explode('.', $column);

                $method = $index === 0 ? 'where' : 'orWhere';

                if (count($arr) == 2) {
                    list($rel, $col) = $arr;

                    $method .= 'Has';

                    $builder->$method($rel, function ($query) use ($search, $col) {
                        $query->where($col, 'like', "%{$search}%");
                    });
                } else if (count($arr) == 1) {
                    $builder->$method($column, 'like', "%{$search}%");
                }
            }
        }
    }
}
