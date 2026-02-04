<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Dyrynda\Database\Support\CascadeSoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Bidding extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;
    use CascadeSoftDeletes;
    use Filterable;

    protected $table = 'biddings';

    protected $fillable = [
        'modality_id',
        'situation_id',
        'title',
        'slug',
        'login',
        'bidding',
        'notice',
        'process',
        'value_min',
        'value_max',
        'published_at',
        'realized_at',
        'local',
        'content',
        'status'
    ];

    protected $cascadeDeletes = ['bidding_agreements'];
    protected $dates = [
        'published_at',
        'realized_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function modality(): BelongsTo
    {
        return $this->belongsTo(BiddingModality::class, 'modality_id');
    }

    public function situation(): BelongsTo
    {
        return $this->belongsTo(BiddingSituation::class, 'situation_id');
    }

    public function bidding_agreements(): HasMany
    {
        return $this->hasMany(BiddingAgreement::class, 'bidding_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(BiddingItem::class, 'bidding_id');
    }

    public function winners(): HasMany
    {
        return $this->hasMany(BiddingWinner::class, 'bidding_id');
    }
}
