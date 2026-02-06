<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
class IndividualPerson extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'individual_person';

    protected $fillable = [
        'birthdate'
    ];

    protected $dates = [
        'birthdate'
    ];

    public function personable(): MorphOne
    {
        return $this->morphOne(Person::class, 'personable');
    }
}
