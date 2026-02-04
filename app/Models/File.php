<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class File extends Model  implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'files';

    protected $fillable = [
        'file_type_id',
        'title',
        'url'
    ];

    public function file_type(): BelongsTo
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }

    public function agreements(): BelongsToMany
    {
        return $this->belongsToMany(BiddingAgreement::class);
    }

    public function biddings(): BelongsToMany
    {
        return $this->belongsToMany(Bidding::class);
    }

    public function legislations(): BelongsToMany
    {
        return $this->belongsToMany(Legislation::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function revenues(): BelongsToMany
    {
        return $this->belongsToMany(Revenue::class);
    }

    public function expenses(): BelongsToMany
    {
        return $this->belongsToMany(Expense::class);
    }

    public function official_diaries(): BelongsToMany
    {
        return $this->belongsToMany(OfficialDiary::class);
    }
}
