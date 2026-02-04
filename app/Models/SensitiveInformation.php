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

class SensitiveInformation extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'sensitive_informations';

    protected $fillable = [
        
        'title',
        'description',
        'category_id',
        'responsible_id',
        'archive',
        'excerpt',
        'body',
    ];

    protected $dates = [
        'deleted_at'
    ];
    
    const PUBLISHED = 'PUBLISHED';

    public function category(): BelongsTo
    {
        return $this->belongsTo(SensitiveInformationCategory::class, 'category_id');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(SensitiveInformationResponsible::class, 'responsible_id');
    }

    public function sensitiveInformationMedia(): HasMany
    {
        return $this->hasMany(SensitiveInformationMedia::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    /*public function newsFilter()
    {
        return $this->provideFilter(\App\ModelFilters\NewsFilter::class);
    }*/
}
