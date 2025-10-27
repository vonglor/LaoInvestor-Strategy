<?php

// app/Repositories/StrategiesRepository.php

namespace App\Repositories;

use App\Models\Strategies;

class StrategiesRepository
{
    /**
     * ດຶງລາຍການ Symbols ທີ່ຖືກຈັດຮູບແບບສຳລັບ Select Input.
     *
     * @return \Illuminate\Support\Collection
     */
    
    public function percentStrategies(string $id)
    {
        $strtegies = Strategies::find($id);
    }


}