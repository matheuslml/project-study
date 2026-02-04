<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Legislation extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'legislations';

    protected $fillable = [
        'category_id',
        'situation_id',
        'ementa',
        'number',
        'number_complement',
        'date',
        'initial_term',
        'final_term',
        'information',
        'excerpt',
        'body',
        'meta_description',
        'status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function bonds(): HasMany
    {
        return $this->hasMany(LegislationBond::class, 'base_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(LegislationCategory::class);
    }

    public function situation(): BelongsTo
    {
        return $this->belongsTo(LegislationSituation::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(LegislationAuthor::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(LegislationSubject::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class);
    }

    public function legislationFilter()
    {
        return $this->provideFilter(\App\ModelFilters\LegislationFilter::class);
    }
}
