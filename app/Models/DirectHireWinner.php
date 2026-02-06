<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DirectHireWinner extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'direct_hire_winners';

    protected $fillable = [
        'direct_hire_id',
        'person_id',
    ];

    public function directHire(): BelongsTo
    {
        return $this->belongsTo(DirectHire::class, 'direct_hire_id');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
