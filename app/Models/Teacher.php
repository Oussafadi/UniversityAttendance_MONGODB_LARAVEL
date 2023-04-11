<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;
    protected $connection   = 'mongodb';

    public function module(): BelongsTo
    {

        return  $this->belongsTo(Module::class);
    }

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}
