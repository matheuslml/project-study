<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class NewsFilter extends ModelFilter
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

    public function category($category_id)
    {
        return $this->where('category_id', $category_id);
    }
    
    public function status($status)
    {
        return $this->where('status', '=', $status);
    }
}
