<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class InvoiceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
                'name'          => $row['client'],
                'numberInv'     => $row['factura'],
                'amount'        => $row['valoare'],
                'rest'          => $row['valoare'],
                'dateInv'       => Carbon::createFromFormat('d/m/Y', $row['dataemiterii'])->format('Y-m-d'),
                'status'        => $row['status'],
                'student_id'    => $row['student']
        ]);
    }
}
