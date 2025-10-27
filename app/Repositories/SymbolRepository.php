<?php

// app/Repositories/SymbolRepository.php

namespace App\Repositories;

use App\Models\Symbol;

class SymbolRepository
{
    /**
     * ດຶງລາຍການ Symbols ທີ່ຖືກຈັດຮູບແບບສຳລັບ Select Input.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSymbols()
    {
        return Symbol::orderBy('id', 'desc')->get();
    }
}