<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class LegislationBondFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */

    public $relations = [];

    public function base($base_id)
    {
        return $this->where('base_id', $base_id);
    }

    public function vinculo($vinculo_id)
    {
        return $this->where('vinculo_id', $vinculo_id);
    }
    
    public function status($status)
    {
        return $this->where('status', 'LIKE', '%' . $status . '%');
    }
    
    public function active($active)
    {
        return $this->where('active', '=', $active);
    }
}
