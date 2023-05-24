<?php

namespace App\Exports;

use App\Sale;//<—modelo creado
use App\Client;
use App\saleDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SaleExport implements FromCollection,WithHeadings,WithMapping,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Cliente',
            'Producto',
            'Fecha',
            'Tipo de comprobante',
            'Número de comprobante',
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
        $saleDetails = $sale->saleDetails; // Obtener los detalles de venta para esta venta
        $productNames = $saleDetails->pluck('product.name')->implode(', '); // Obtener los nombres de los productos de los detalles de venta

        return [
            $sale->id,
            $sale->client->name,
            $productNames,
            $sale->sale_date,
            $sale->document_type,
            $sale->document_number,
            $sale->total,
            $sale->status,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30, // Columna 'Cliente'
            'C' => 50, // Columna 'Producto'
            'D' => 17, // Columna 'fecha'
            'E' => 19, // Columna 'Tipo de comprobante'
            'F' => 22, // Columna 'Numero de comprobante'
            'G' => 9, // Columna 'total'
            'H' => 9, // Columna 'Estado'
        ];
    }
}