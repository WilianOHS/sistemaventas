<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CombinedSalesAndPurchasesExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $combinedData = [];
    
        // Combina las colecciones de ventas y compras y ordénalas por fecha
        $combinedCollection = $this->data['sales']->concat($this->data['purchases'])->sortBy('Fecha');
    
        // Itera sobre la colección combinada
        foreach ($combinedCollection as $item) {
            // Determina el tipo (Venta o Compra) basado en el modelo
            $tipo = $item instanceof \App\Sale ? 'Venta' : 'Compra';
    
            if ($item instanceof \App\Sale) {
                // Si es una venta, obtén los detalles de productos de la venta
                foreach ($item->saleDetails as $saleDetail) {
                    $combinedData[] = [
                        'Tipo' => $tipo,
                        'Fecha' => $item->sale_date ?? $item->purchase_date,
                        'Monto' => $item->total,
                        'Producto' => $saleDetail->product ? $saleDetail->product->name : 'Producto no encontrado',
                        'Cantidad' => $saleDetail->quantity,
                        'Precio' => $saleDetail->price,
                    ];
                }
            } elseif ($item instanceof \App\Purchase) {
                // Si es una compra, obtén los detalles de productos de la compra
                foreach ($item->purchaseDetails as $purchaseDetail) {
                    $combinedData[] = [
                        'Tipo' => $tipo,
                        'Fecha' => $item->sale_date ?? $item->purchase_date,
                        'Monto' => $item->total,
                        'Producto' => $purchaseDetail->product ? $purchaseDetail->product->name : 'Producto no encontrado',
                        'Cantidad' => $purchaseDetail->quantity,
                        'Precio' => $purchaseDetail->price,
                    ];
                }
            }
        }
    
        return collect($combinedData);
    }
    
    
    
    
    public function headings(): array
    {
        return [
            'Tipo',
            'Fecha',
            'Monto',
            'Producto',
            'Cantidad',
            'Precio',
            // Agregar más encabezados según tus datos
        ];
    }
}

