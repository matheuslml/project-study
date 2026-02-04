<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileProject extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'file_project';

    protected $fillable = [
        'project_id',
        'file_id',
    ];

    protected $dates = [
        'deleted_at'
    ];
}
