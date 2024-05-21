<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css')}}">
</head>
<body>
    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold;"> Sistema LWPOS </span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative;">
                    <img src="{{asset('assets/img/livewire_logo.png')}}" alt="" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px;">
                @if ($reportType == 0)
                    <span style="font-size: 16px;"> <strong> Reporte de Ventas del Día </strong></span>
                @else
                    <span style="font-size: 16px;"> <strong> Reporte de Ventas por Fechas </strong></span>
                @endif
                <br>
                @if ($reportType !=0)
                    <span style="font-size: 16px;"> <strong> Reporte de Consulta: {{\Carbon\Carbon::parse($dateFrom)->format('d-M-Y')}} al {{\Carbon\Carbon::parse($dateTo)->format('d-M-Y')}} </strong></span>
                @else
                    <span style="font-size: 16px;"> <strong> Fecha de Consulta: {{\Carbon\carbon::now()->format('d-M-Y')}} </strong></span>
                @endif
                <br>
                <span style="font-size: 14px;">Usuario: {{$user}}</span>
                </td>
            </tr>
        </table>
    </section>
    <section style="margin-top: -110px;">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="10%">SKU</th>
                    <th width="12%">NAME</th>
                    <th width="12%">CATEGORIA</th>
                    <th width="12%">MARCA</th>
                    <th width="12%">CANTIDAD</th>
                    <th width="12%">PRECIO VENTA</th>
                    <th width="12%">PRECIO COSTO</th>
                    <th width="12%">FECHA</th>
                    {{-- <th width="12%">GANANCIA</th>
                    <th width="12%">Rentabilidad</th> --}}
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{$item['sku']}}</td>
                        <td class="text-center">{{$item['name']}}</td>
                        <td class="text-center">{{$item['categoria']}}</td>
                        <td class="text-center">{{$item['marca']}}</td>
                        <td class="text-center">{{$item['cantidad']}}</td>
                        <td class="text-center">{{env('MONEDA', 'S/. ')}}{{number_format($item['precio_venta'],2)}}</td>
                        <td class="text-center">{{env('MONEDA', 'S/. ')}}{{number_format($item['precio_costo'],2)}}</td>
                        {{-- <td class="text-center">{{$item->status}}</td>
                        <td class="text-center">{{$item->user}}</td> --}}
                        <td class="text-center">{{$item['fecha']}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">
                        <span><b>TOTALES</b></span>
                    </td>
                    <td class="text-center" colspan="1"> 
                        <span><strong>{{env('MONEDA', 'S/. ')}}{{number_format($data->sum('precio_venta'),2)}}</strong> </span>
                    </td>
                    <td class="text-center">
                        <h5>Cantidad Total: </h5>
                        {{$data->sum('cantidad')}}
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </section>
    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistema LWPOS v1</span>
                </td>
                <td width="60%" class="text-center">
                    Pedro R. Aguirre
                </td>
                <td class="text-center" width="20%">
                    página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </section>
</body>
</html>