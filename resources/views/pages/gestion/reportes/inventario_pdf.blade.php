<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inventario</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .encabezado { text-align: center; }
        .datos { margin-top: 10px; margin-bottom: 20px; font-size: 11px; }
        .datos td { padding: 2px 5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px; text-align: center; }
        .totales td { font-weight: bold; }
    </style>
</head>
<body>
    <div class="encabezado">
        <h2>FERRETERIA CASTILLO S.R.L</h2>
        <p>Matriz: Av Francisco Orellana - Sucursal: Alborada Décima Etapa<br>Teléfonos: 0998044301</p>
        <h3>REPORTE DE LISTAS DE PRODUCTOS</h3>
    </div>

    <table class="datos">
        <tr>
            <td><strong>Desde:</strong> {{ request('fecha_desde') ?? '---' }}</td>
            <td><strong>Hasta:</strong> {{ request('fecha_hasta') ?? '---' }}</td>
            <td><strong>Área:</strong> Ferretería</td>
            <td><strong>Categoría:</strong> {{ request('categoria') ?? 'Todas' }}</td>
            <td><strong>Usuario:</strong> {{ auth()->user()->name ?? '---' }}</td>
            <td><strong>Fecha impresión:</strong> {{ now()->format('d/m/Y') }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Descripcion</th>
                <th>Categoría</th>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Bajas</th>
                <th>Stock</th>
                <th>Ubicacion de Existencias</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $p)
                <tr>
                    <td>{{ $p['codigo'] }}</td>
                    <td>{{ $p['nombre'] }}</td>
                     <td>{{ $p['descripcion'] }}</td>
                    <td>{{ $p['categoria'] }}</td>
                    <td>{{ $p['entradas'] }}</td>
                    <td>{{ $p['salidas'] }}</td>
                    <td>{{ $p['bajas'] }}</td>
                    <td>{{ $p['stock'] }}</td>
                     <td>{{ $p['ubicacion_existencias'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
