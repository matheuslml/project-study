<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class OfficialDiary extends Model implements Auditable
{
    use SoftDeletes, AuditableTrait;

    protected $table = 'official_diaries';

    protected $fillable = [
        'edition',
        'extra_edition',
        'published_at',
        'description',
        'content',
        'type',
        'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function acts(): HasMany
    {
        return $this->hasMany(Act::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function certificates(): BelongsToMany
    {
        return $this->belongsToMany(Certificate::class);
    }

    public function scopeEdition(Builder $query, string $order = 'DESC'): void
    {
        $validatedOrder = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

        $query->orderByRaw(
            "CAST(edition AS UNSIGNED) $validatedOrder"
        );
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'PUBLISHED');
    }
}
