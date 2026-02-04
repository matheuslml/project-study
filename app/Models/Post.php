<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Post extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'posts';

    protected $fillable = [
        'type_post_id',
        'user_id',
        'title',
        'sub_title',
        'slug',
        'order',
        'link',
        'content',
        'active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type_post(): BelongsTo
    {
        return $this->belongsTo(TypePost::class, 'type_post_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
