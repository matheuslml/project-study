<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DepartamentPerson extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'departament_person';

    protected $fillable = [
        'departament_id',
        'person_id'
    ];
}
