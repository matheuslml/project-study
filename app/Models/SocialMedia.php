<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class SocialMedia extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'social_media';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'logo',
        'title'
    ];

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class)->withPivot('id', 'url');
    }

    public function leaderships(): BelongsToMany
    {
        return $this->belongsToMany(Leadership::class)->withPivot('id', 'url');
    }
}
