<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class ActTopic extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'act_topics';

    protected $fillable = [
        'act_topic_id',
        'title',
        'status'
    ];

    public function actTopic(): BelongsTo
    {
        return $this->belongsTo(ActTopic::class, 'act_topic_id');
    }

    public function actTopics(): HasMany
    {
        return $this->hasMany(ActTopic::class);
    }
}
