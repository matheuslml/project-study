<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class BiddingWinner extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'bidding_winners';

    protected $fillable = [
        'bidding_id',
        'person_id',
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
