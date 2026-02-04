<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Banner extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'banners';

    protected $fillable = [
        'banner_type_id',
        'title',
        'image',
        'status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(BannerType::class, 'banner_type_id');
    }
}
