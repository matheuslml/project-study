<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Certificate extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'certificates';

    protected $fillable = [
        'name',
        'description',
        'registration',
        'cpf',
        'position',
        'url_certificate',
        'url_logo',
        'url_signature',
        'status'
    ];

    public function officialDiaries(): BelongsToMany
    {
        return $this->belongsToMany(OfficialDiary::class);
    }
}
