<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class FileOfficialDiary extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'file_official_diary';

    protected $fillable = [
        'file_id',
        'official_diary_id'
    ];

    public function officialDiary(): BelongsTo
    {
        return $this->belongsTo(OfficialDiary::class, 'official_diary_id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');

    }
}
