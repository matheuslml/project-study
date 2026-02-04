<?php 

namespace App\Models\ModelFilters;

use EloquentFilter\ModelFilter;

class BiddingAgreementFilter extends ModelFilter
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

    public function origin($origin_id)
    {
        return $this->where('origin_id', $origin_id);
    }

    public function situation($situation_id)
    {
        return $this->where('situation_id', $situation_id);
    }

    public function type($type_id)
    {
        return $this->where('type_id', $type_id);
    }

    public function process($process)
    {
        return $this->where('process', $process);
    }

    public function contract($contract)
    {
        return $this->where('contract', $contract);
    }

    public function signature($date_signature)
    {
        return $this->whereDate('date_signature', '=', $date_signature);
    }

    public function diary($date_diary)
    {
        return $this->whereDate('date_diary', '=', $date_diary);
    }
}
