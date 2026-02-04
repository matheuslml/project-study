<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Act extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'acts';

    protected $fillable = [
        'official_diary_id',
        'act_topic_id',
        'act_type',
        'title',
        'excerpt',
        'body',
        'published_at',
        'order',
        'status'
    ];

    public function officialDiary(): BelongsTo
    {
        return $this->belongsTo(OfficialDiary::class, 'official_diary_id');
    }

    public function actTopic(): BelongsTo
    {
        return $this->belongsTo(ActTopic::class, 'act_topic_id');
    }
}
