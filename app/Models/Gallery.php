<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Gallery extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'galleries';

    protected $fillable = [
        'gallery_type_id',
        'title',
        'order',
        'image_small',
        'image_large',
        'status'
    ];

    public function gallery_type(): BelongsTo
    {
        return $this->belongsTo(GalleryType::class, 'gallery_type_id');
    }
}
