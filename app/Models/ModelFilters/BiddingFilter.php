<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class BiddingFilter extends ModelFilter
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

    public function modality($modality_id)
    {
        return $this->where('modality_id', $modality_id);
    }

    public function situation($situation_id)
    {
        return $this->where('situation_id', $situation_id);
    }

    public function active($active)
    {
        return $this->where('active', $active);
    }

    public function bidding($bidding)
    {
        return $this->where('bidding', 'LIKE', '%' . $bidding);
    }

    public function process($process)
    {
        return $this->where('process', $process);
    }

    public function publishedAt($published_at)
    {
        return $this->whereDate('published_at', '=', $published_at);
    }

    public function dateStart($date_start)
    {
        return $this->where('published_at', '>=', $date_start);
    }

    public function dateEnd($date_end)
    {
        return $this->where('published_at', '<=', $date_end);
    }
}
