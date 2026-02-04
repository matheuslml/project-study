<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class SensitiveInformationMedia extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'sensitive_information_media';

    protected $fillable = [
        'project_id',
        'url'
    ];

    public function sensitiveInformation(): BelongsTo
    {
        return $this->belongsTo(SensitiveInformation::class, 'sensitive_information_id');
    }
}
