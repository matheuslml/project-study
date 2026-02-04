<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Expense extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;
    use Filterable;

    protected $table = 'expenses';

    protected $fillable = [
        'type_expense_id',
        'user_id',
        'register',
        'title',
        'slug',
        'source',
        'current_balance',
        'blocked_balance',
        'used_balance',
        'available_balance',
        'status',
        'notes'
    ];

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function typeExpense(): BelongsTo
    {
        return $this->belongsTo(TypeExpense::class, 'type_expense_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function expenseFilter()
    {
        return $this->provideFilter(\App\ModelFilters\ExpenseFilter::class);
    }
}
