<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tindakan extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function layanan() : BelongsTo 
    {
        return $this->belongsTo(Layanan::class, 'layanan_id')    ;
    }
}
