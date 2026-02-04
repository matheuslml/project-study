<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class BlankPage extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'blank_pages';

    protected $fillable = [
        'blank_page_type_id',
        'title',
        'sub_title',
        'link_url',
        'only_link',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
        'description'
    ];

    const PUBLISHED = 'PUBLISHED';

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value) . date("Y/m/d");
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(BlankPageType::class, 'blank_page_type_id');
    }
}
