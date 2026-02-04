<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class LegislationLegislationSubjects extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'legislation_legislation_subject';

    protected $fillable = [
        'legislation_id',
        'legislation_subject_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function legislation()
    {
        return $this->belongsTo(Legislation::class, 'legislation_id');
    }

    public function subject()
    {
        return $this->belongsTo(LegislationSubject::class, 'legislation_subject_id');
    }
}
