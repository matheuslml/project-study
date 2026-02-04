<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class ExpenseFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    
    public function title($title)
    {
        return $this->where('title', 'LIKE', '%' . $title . '%');
    }
    
    public function register($register)
    {
        return $this->where('register', 'LIKE', '%' . $register . '%');
    }

    public function type($type_expense_id)
    {
        return $this->where('type_expense_id', $type_expense_id);
    }

    public function dateStart($date_start)
    {
        return $this->where('date', '>=', $date_start);
    }

    public function dateEnd($date_end)
    {
        return $this->where('date', '<=', $date_end);
    }
}
