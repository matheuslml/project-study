<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class LegislationFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */

    public $relations = [];
    
    public function ementa($ementa)
    {
        return $this->where('ementa', 'LIKE', '%' . $ementa . '%');
    }

    public function number($number)
    {
        return $this->where('number', $number);
    }

    public function numberComplement($number_complement)
    {
        return $this->where('number_complement', 'LIKE', '%' . $number_complement . '%');
    }

    public function category($category_id)
    {
        return $this->where('category_id', $category_id);
    }

    public function situation($situation_id)
    {
        return $this->where('situation_id', $situation_id);
    }
    
    public function active($active)
    {
        return $this->where('active', '=', $active);
    }

    public function date($date)
    {
        return $this->whereDate('date', '=', $date);
    }

    public function initialTerm($initial_term)
    {
        return $this->whereDate('initial_term', '=', $initial_term);
    }

    public function finalTerm($final_term)
    {
        return $this->whereDate('final_term', '=', $final_term);
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
