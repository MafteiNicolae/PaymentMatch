<?php

namespace App\Imports;

use App\Models\Incoming;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class IncomingImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $incomings = new Incoming([
            'name'          => $row['ordonator'],
            'amount'        => $row['suma'],
            'type'          => $row['tip'],
            'due'           => $row['suma'],
        ]);

        if ($incomings->shouldImport()) {
            return $incomings;
        }

        return null;
    }
    
}
