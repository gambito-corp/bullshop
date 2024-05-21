<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\FromCollection;      // para trabajar con colecciones y obtener la data
use Maatwebsite\Excel\Concerns\WithHeadings;        // para definir los títulos del encabezado
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;   // para interactuar con el libro
use Maatwebsite\Excel\Concerns\WithCustomStartCell; // para definir la celda donde inicia el reporte
use Maatwebsite\Excel\Concerns\WithTitle;           // para colocar nombre a las hojas del libro
use Maatwebsite\Excel\Concerns\WithStyles;          // para dar formato a las celdas
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;



class SalesExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles, WithColumnFormatting, WithColumnWidths
{
    use Exportable;
    protected $userId, $dateFrom, $dateTo, $reportType;
    
    function __construct($userId, $reportType, $f1, $f2)
    {
        $this->userId = $userId;
        $this->reportType = $reportType;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
    }

    public function collection()
    {
        $data = [];
        if ($this->reportType == 0) {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        } else {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if ($this->userId == 0) {
            // SKU	NAME	CATEGORIA	MARCA	CANTIDAD	PRECIO VENTA	PRECIO COSTO	GANANCIA	Rentabilidad

            $data = SaleDetails::with('Producto')
            ->whereBetween('created_at', [$from, $to])
            ->get();
            $data1 = collect();
            foreach ($data as $key => $value) {
                // dd($value->Producto);
                // dd($data3);
                $categoria = $value->Producto->load('category');
                $data2 = [
                    'folio'         => $value->sale_id,
                    'sku'           => $value->Producto->barcode,
                    'name'          => $value->Producto->name,
                    'categoria'     => $categoria->category->name,
                    'marca'         => $value->Producto->marca,
                    'cantidad'      => intval($value->quantity),
                    'precio_venta'  => intval($value->price),
                    'precio_costo'  => intval($value->costo),
                    'ganancia'      => '',
                    'rentabilidad'  => '',
                    'fecha'         => \Carbon\Carbon::parse($value->created_at)->format('d-M-Y'),
                ];
                $data1->push($data2);
                // dump($value, $data4);
            }
                $data = $data1;
        } else {
            $data = Sale::with('Detalles')
            ->whereBetween('created_at', [$from, $to])
            ->where('user_id', $this->userId)
            ->get();

            $data1 = collect();
            $data->each(function($item, $key) use($data, $data1){
                // dump($item->Detalles);
                foreach ($item->Detalles as $key => $value) {
                    // dd($value->Producto);
                    // dd($data3);
                    $categoria = $value->Producto->load('category');
                    $data2 = [
                        'folio'         => $value->sale_id,
                        'sku'           => $value->Producto->barcode,
                        'name'          => $value->Producto->name,
                        'categoria'     => $categoria->category->name,
                        'marca'         => $value->Producto->marca,
                        'cantidad'      => intval($value->quantity),
                        'precio_venta'  => intval($value->price),
                        'precio_costo'  => intval($value->costo),
                        'ganancia'      => '',
                        'rentabilidad'  => '',
                        'fecha'         => \Carbon\Carbon::parse($value->created_at)->format('d-M-Y'),
                    ];
                    $data1->push($data2);
                    // dump($value, $data4);
                }
            });
                $data = $data1;
        }

        return $data;
    }
    // cabeceras del reporte
    public function headings() : array
    {
        return [
            'FOLIO',
            'SKU',
            'NAME',
            'CATEGORIA',
            'MARCA',
            'CANTIDAD',
            'PRECIO VENTA',
            'PRECIO COSTO',
            'GANANCIA',
            'RENTABILIDAD',
            'FECHA',
        ];
    }
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_CURRENCY_USD,
            'F' => NumberFormat::FORMAT_CURRENCY_USD,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
    public function startCell(): string
    {
        return 'A2';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            2 => ['font' => ['bold' => true]], 

        ];
        
    }

    public function title() : string
    {
        return 'Reporte de Ventas';
    }

    public function columnWidths(): array
    {
        return [
            'E' => 40,
        ];
    }

}
