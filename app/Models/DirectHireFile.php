<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DirectHireFile extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'direct_hire_file';

    protected $fillable = [
        'direct_hire_id',
        'file_id'
    ];

    public function directHire(): BelongsTo
    {
        return $this->belongsTo(DirectHire::class, 'direct_hire_id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id'); 
        
    }
}
