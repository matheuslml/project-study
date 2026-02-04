<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class LegislationBond extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'legislation_bonds';

    protected $fillable = [
        'base_id',
        'vinculo_id',
        'status',
        'active',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function base()
    {
        return $this->belongsTo(Legislation::class, 'base_id');
    }

    public function vinculo()
    {
        return $this->belongsTo(Legislation::class, 'vinculo_id');
    }

    public function legislationBondFilter()
    {
        return $this->provideFilter(\App\ModelFilters\LegislationBondFilter::class);
    }
    
}