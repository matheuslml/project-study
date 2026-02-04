<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class LegislationSubject extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'legislation_subjects';

    protected $fillable = [
        'subject',
        'active'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function legislations(): BelongsToMany
    {
        return $this->belongsToMany(Legislation::class);
    }
}
