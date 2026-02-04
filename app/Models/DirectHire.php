<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DirectHire extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'direct_hires';

    protected $fillable = [
        'modality_id',
        'situation_id',
        'title',
        'slug',
        'login',
        'bidding',
        'notice',
        'process',
        'value_min',
        'value_max',
        'published_at',
        'realized_at',
        'local',
        'content',
        'status'
    ];

    protected $dates = [
        'published_at',
        'realized_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function modality(): BelongsTo
    {
        return $this->belongsTo(DirectHireModality::class, 'modality_id');
    }

    public function situation(): BelongsTo
    {
        return $this->belongsTo(DirectHireSituations::class, 'situation_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }
    
    public function items(): HasMany
    {
        return $this->hasMany(DirectHireItem::class, 'direct_hire_id');
    }
    
    public function winners(): HasMany
    {
        return $this->hasMany(DirectHireWinner::class, 'direct_hire_id');
    }

    public function directHireFilter()
    {
        return $this->provideFilter(\App\ModelFilters\directHireFilter::class);
    }
}
