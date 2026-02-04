<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class WebFooterLogo extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'web_footer_logos';

    protected $fillable = [
        'web_footer_id',
        'title',
        'logo_url',
        'link_url',
        'status'
    ];

    public function web_footer(): BelongsTo
    {
        return $this->belongsTo(WebFooter::class, 'web_footer_id');
    }
}
