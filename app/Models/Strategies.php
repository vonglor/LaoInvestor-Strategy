<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Symbol;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Strategies extends Model
{


 /**
     * Strategies ເປັນຂອງ Symbol ຄົນດຽວ
     */
    public function symbol(): BelongsTo
    {
        return $this->belongsTo(Symbol::class);
    }


    protected $fillable = [
        'symbol_id',
        'user_id',
        'name',
        'rr',
        'timeframe',
        'status',
        'datestart',
        'dateend',
        'win',
        'loss',
    ];



}
