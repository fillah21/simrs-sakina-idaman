<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function instalasi(): BelongsTo
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id');
    }
}
