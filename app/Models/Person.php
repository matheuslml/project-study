<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\Pass;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
class Person extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;


    protected $table = 'person';

    protected $cascadeDeletes = ['documents', 'addresses', 'personable'];

    protected $fillable = [
        'full_name',
        'social_name',
        'genre',
        'matrial_status',
        'user_id',
        'personable_id',
        'personable_type'
    ];

    protected $dates = [
        'birthdate',
        'deleted_at'
    ];

    public function personable(): MorphTo
    {
        return $this->morphTo('personable');
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class, 'person_id');
    }

    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }

    public function departaments(): BelongsToMany
    {
        return $this->belongsToMany(Departament::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class, 'person_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'person_id')->withDefault();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'person_id');
    }

    public function genreData(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre');
    }

    public function matrialStatus(): BelongsTo
    {
        return $this->belongsTo(MatrialStatus::class, 'matrial_status');
    }

    public function getFirstNameAttribute(): string
    {
        if ($this->personable_type === IndividualPerson::class) {
            return Str::before($this->full_name, ' ');
        }
        return $this->name;
    }

    public function getLastNameAttribute(): string
    {
        if ($this->personable_type === IndividualPerson::class) {
            $name = explode(' ', $this->full_name);
            return array_pop($name);
        }
        return '';
    }

    public function getFullNameAttribute($value): string
    {
        if ($this->personable_type === IndividualPerson::class) {
            return mb_strtoupper($value);
        }
        return mb_strtoupper($this->personable->company_name ?? $value);
    }

    public function setFullNameAttribute($value): void
    {
        $this->attributes['full_name'] = mb_strtoupper($value);
    }

    public function isAnonPerson(){
        return (
            $this->personable_type === IndividualPerson::class &&
            $this->personable->anonPerson
        );
    }

    public function winners(): HasMany
    {
        return $this->hasMany(BiddingWinner::class, 'person_id');
    }
}
