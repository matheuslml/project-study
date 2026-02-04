<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Ombudsman extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'ombudsmen';

    protected $fillable = [
        'type_request_id',
        'access_id',
        'name',
        'email',
        'title',
        'slug',
        'protocol',
        'answer',
        'status',
        'content'
    ];

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function type_access(){
        return $this->hasOne( related: TypeAccess::class, foreignKey: 'id', localKey: 'access_id');
    }

    public function type_request(){
        return $this->hasOne( related: TypeRequest::class, foreignKey: 'id', localKey: 'type_request_id');
    }
}
