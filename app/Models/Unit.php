<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Unit extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'units';

    protected $fillable = [
        'organization_id',
        'name',
        'sigla',
        'phone',
        'email',
        'operation',
        'address',
        'google_maps_link',
        'google_maps_iframe',
        'web',
        'logo',
        'icon',
        'document'
    ];

    public function document_type(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function departaments(): HasMany
    {
        return $this->hasMany(Departament::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function socialMedia():BelongsToMany
    {
        return $this->belongsToMany(SocialMedia::class)->withPivot('id', 'url');
    }
    
    public function about(): HasOne
    {
        return $this->hasOne(About::class);
    }
}
