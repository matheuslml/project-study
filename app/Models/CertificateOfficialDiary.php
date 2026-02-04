<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class CertificateOfficialDiary extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'certificate_official_diary';

    protected $fillable = [
        'certificate_id',
        'official_diary_id'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function Certificate(): BelongsTo
    {
        return $this->belongsTo(Certificate::class);
    }

    public function official_diary(): BelongsTo
    {
        return $this->belongsTo(OfficialDiary::class);
    }
}
