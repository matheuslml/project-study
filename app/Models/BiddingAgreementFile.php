<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class BiddingAgreementFile extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;


    protected $table = 'bidding_agreement_file';

    protected $cascadeDeletes = ['file'];
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'bidding_agreement_id',
        'file_id'
    ];

    public function bidding_agreement(): BelongsTo
    {
        return $this->belongsTo(BiddingAgreement::class, 'bidding_id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
