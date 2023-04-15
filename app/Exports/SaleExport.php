<?php

namespace App\Exports;

use App\Sale;//<—modelo creado
use App\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SaleExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Cliente',
            'Fecha',
            'Total',
            'Estado',
        ];
    }
    public function collection()
    {
        $sales = Sale::get();
        return $sales;

    }
    public function map($sale): array
    {
        return [
            $sale->id, 
            $sale->client->name, 
            $sale->sale_date, 
            $sale->total, 
            $sale->status, 
        ];
    }
}