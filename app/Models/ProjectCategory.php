<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class ProjectCategory extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'project_categories';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description'
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
