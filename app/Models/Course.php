<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use SoftDeletes, HasFactory;
    const UPDATED_AT = null;

    protected $fillable = [
        'title',
        'description',
        'status',
        'is_premium',
    ];
}
