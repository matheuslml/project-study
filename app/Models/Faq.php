<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Faq extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'answer',
        'status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /*public function newsFilter()
    {
        return $this->provideFilter(\App\ModelFilters\NewsFilter::class);
    }*/
}