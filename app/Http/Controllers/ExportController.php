<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Http\Controllers\Helpers;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function reportPDF($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $data = [];
        if ($reportType == 0) {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        } else {
            $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if ($userId == 0) {
           
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
            ->where('user_id', $userId)
            ->get();

            $data1 = collect();
            $data->each(function($item, $key) use($data, $data1){
                // dump($item->Detalles);
                foreach ($item->Detalles as $key => $value) {
                    // dd($value->Producto);
                    // dd($data3);
                    $categoria = $value->Producto->load('category');
                    $data2 = [
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
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        $pdf = PDF::loadView('pdf.reporte', compact('data', 'reportType', 'user', 'dateFrom', 'dateTo'));
        // dd($pdf);

        return $pdf->stream('salesReport.pdf'); // visualizar
        //return $pdf->download('salesReport.pdf'); // descargar
        // Reporte con fecha del día de consulta del nombre del PDF
        $customReportName = 'Reporte de Ventas_'.Carbon::now()->format('d-m-Y').'-'. uniqid() .'.pdf'; 
        return $pdf->download($customReportName);
    }

    public function reporteExcel($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $reportName = 'Reporte de Ventas_' .Carbon::now()->format('d-m-Y').'-'. uniqid() . '.xlsx';
        return Excel::download(new SalesExport($userId, $reportType, $dateFrom, $dateTo), $reportName );
    }
}
