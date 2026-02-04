<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class LeadershipSocialMedia extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'leadership_social_media';

    protected $fillable = [
        'leadership_id',
        'social_media_id',
        'url'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
