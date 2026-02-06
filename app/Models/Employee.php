<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
class Employee extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'employees';

    protected $fillable = [
      'registry',
      'person_id'
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(person::class, 'person_id');
    }

    public function departaments(): BelongsToMany
    {
        return $this->belongsToMany(departament::class, 'departament_employee', 'employee_id', 'departament_id')
            ->withTimestamps();
    }
}
