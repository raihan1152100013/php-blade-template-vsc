<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\MoneyCast;
 
class Treatment extends Model
    {
        protected $casts = [
            'price' => MoneyCast::class,
        ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(patient::class);
    }

    use HasFactory;
    }
