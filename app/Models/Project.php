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

class Project extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'projects';

    protected $fillable = [
        'category_id',
        'project_responsible_id',
        'title',
        'sub_title',
        'description',
        'amount',
        'term',
        'excerpt',
        'body',
        'thumb',
        'meta_description',
        'status',
    ];

    protected $dates = [
        'deleted_at'
    ];

    const PUBLISHED = 'PUBLISHED';

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function projectMedia(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
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
