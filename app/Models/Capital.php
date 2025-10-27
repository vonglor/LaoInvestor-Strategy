<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Capital extends Model
{
        protected $fillable = [
            'user_id',
            'capital',
            'risk_per_trade',
        ];



        /**
         * Get the user that owns the Capital
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
}
