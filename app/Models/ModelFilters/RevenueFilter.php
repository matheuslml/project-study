<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class RevenueFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */

    public $relations = [
    ];
    
    public function description($description)
    {
        return $this->where('description', 'LIKE', '%' . $description . '%');
    }

    public function date($date)
    {
        return $this->whereDate('receipt_at', '=', $date);
    }

    public function dateStart($date_start)
    {
        return $this->where('receipt_at', '>=', $date_start);
    }

    public function dateEnd($date_end)
    {
        return $this->where('receipt_at', '<=', $date_end);
    }
}
