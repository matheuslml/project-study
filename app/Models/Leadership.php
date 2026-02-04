<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Leadership extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'leaderships';

    protected $fillable = [
        'name',
        'occupation',
        'order',
        'photo',
        'type',
        'status'
    ];

    public function socialMedia():BelongsToMany
    {
        return $this->belongsToMany(SocialMedia::class)->withPivot('id', 'url');
    }
}
