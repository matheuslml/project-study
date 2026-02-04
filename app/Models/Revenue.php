<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Revenue extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'revenues';

    protected $fillable = [
        'type_id',
        'description',
        'value',
        'receipt_at',
        'collection_initial_at',
        'collection_final_at',
        'referent',
        'notes',
        'status'
    ];

    protected $dates = [
        'receipt_at',
        'collection_initial_at',
        'collection_final_at',
        'deleted_at'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(RevenueType::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function revenueFilter()
    {
        return $this->provideFilter(\App\ModelFilters\RevenueFilter::class);
    }
}