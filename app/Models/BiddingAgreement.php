<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class BiddingAgreement extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'bidding_agreements';

    protected $fillable = [
        'origin_id',
        'type_id',
        'situation_id',
        'bidding_id',
        'user_id',
        'title',
        'slug',
        'process',
        'contract',
        'document',
        'document_type_id',
        'name',
        'value',
        'supervisor',
        'manager',
        'date_signature',
        'date_validity_init',
        'date_validity_end',
        'date_diary',
        'object',
        'legal_reasoning',
        'observation',
        'status'
    ];

    protected $dates = [
        'date_signature',
        'date_validity_init',
        'date_validity_end',
        'date_diary',
        'deleted_at'
    ];

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function agreementOrigin(): BelongsTo
    {
        return $this->belongsTo(AgreementOrigin::class, 'origin_id');
    }

    public function agreementType(): BelongsTo
    {
        return $this->belongsTo(AgreementType::class, 'type_id');
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function agreementSituation(): BelongsTo
    {
        return $this->belongsTo(AgreementSituation::class, 'situation_id');
    }

    public function bidding(): BelongsTo
    {
        return $this->belongsTo(Bidding::class, 'origin_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function biddingAgreementFilter()
    {
        return $this->provideFilter(\App\ModelFilters\BiddingAgreementFilter::class);
    }
}
