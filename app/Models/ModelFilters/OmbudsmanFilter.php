<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class OmbudsmanFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    
    public function name($name)
    {
        return $this->where('name', 'LIKE', '%' . $name . '%');
    }

    public function request($type_request_id)
    {
        return $this->where('type_request_id', $type_request_id);
    }

    public function access($access_id)
    {
        return $this->where('access_id', $access_id);
    }

    public function created($created_at)
    {
        return $this->whereDate('created_at', '=', $created_at);
    }
}
