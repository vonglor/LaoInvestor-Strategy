<?php

// app/Repositories/SymbolRepository.php

namespace App\Repositories;

use App\Models\Capital;

class CapitalRepository
{
    /**
     * ດຶງລາຍການ Symbols ທີ່ຖືກຈັດຮູບແບບສຳລັບ Select Input.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCapital($id)
    {

        return Capital::where('user_id', $id)->first();
        
    }
}