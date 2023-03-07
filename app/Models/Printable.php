<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Printable extends Model
{
    protected $table = 'printable';

    protected $fillable = [
        'printable_model',
        'printable_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
