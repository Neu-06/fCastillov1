<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h3 { margin: 0; padding: 0; }
        .compra { margin-top: 25px; page-break-inside: avoid; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Reporte de Compras</h2>

    @foreach ($compras as $compra)
        <div class="compra">
            <h3>Compra #{{ $compra->id_compra }}</h3>
            <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombreC_proveedor ?? 'Sin proveedor' }}</p>
            <p><strong>Fecha:</strong> {{ $compra->created_at->format('d/m/Y') }}</p>
            <p><strong>Total:</strong> {{ number_format($compra->total_compra, 2) }} Bs</p>

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
                    @foreach ($compra->detalles as $detalle)
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
