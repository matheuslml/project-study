<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class BiddingItem extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'bidding_items';

    protected $fillable = [
        'bidding_id',
        'person_id',
        'quantity',
        'name',
        'value'
    ];

    public function bidding(): BelongsTo
    {
        return $this->belongsTo(Bidding::class, 'bidding_id');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
