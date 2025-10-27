<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Strategies;

class Symbol extends Model
{

       /**
     * Symbol ມີ Strategies ໄດ້ຫຼາຍອັນ
     */
    public function strategies(): HasMany
    {
        return $this->hasMany(Strategies::class);
    }
    //
  use HasFactory;
     protected $fillable = [
        'name',
    ];
}
