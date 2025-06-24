<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h3 { margin: 0; padding: 0; }
        .venta { margin-top: 25px; page-break-inside: avoid; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>

    @foreach ($ventas as $venta)
        <div class="venta">
            <h3>venta #{{ $venta->id_venta }}</h3>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre_cliente ?? 'Sin Cliente' }}</p>
            <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
            <p><strong>Total:</strong> {{ number_format($venta->total_venta, 2) }} Bs</p>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->detalle as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre_producto ?? 'Sin producto' }}</td>
                            <td>{{ $detalle->producto->descripcion ?? '-' }}</td>
                            <td>{{ number_format($detalle->precio, 2) }}</td>
                            <td>{{ number_format($detalle->cantidad, 2) }}</td>
                            <td>{{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</body>
</html>
