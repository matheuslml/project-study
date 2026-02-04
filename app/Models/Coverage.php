<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coverage extends Model
{
    use HasFactory;
    protected $table = 'coverages';

    protected $fillable = [
            'id',
            'city',
        ];

    public function conservationUnit(): BelongsToMany
    {
        return $this->belongsToMany(ConservationUnit::class);
    }
}
