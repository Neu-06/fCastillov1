<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BitacoraExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;


class BitacoraController extends Controller
{
    public function index(Request $request)
    {
        $query = Bitacora::query();

        if ($request->filled('usuario')) {
            $query->where('nombre_usuario', $request->usuario);
        }

        if ($request->filled('tipo')) {
            $query->where('accion', $request->tipo);
        }

        if ($request->filled('fecha')) {
            $fecha = $request->fecha;
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
                $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('d/m/Y');
            }
            $query->where('fecha_hora', 'like', '%' . $fecha . '%');
        }

        $bitacoras = $query->orderByDesc('id_bitacora')->paginate(10);

        $usuarios = Usuario::orderBy('nombre_usuario')->pluck('nombre_usuario', 'nombre_usuario');

        return view('pages.gestion.bitacoras.index', compact('bitacoras', 'usuarios'));
    }


    public static function registrar($accion, $descripcion)
    {
        $usuario = Auth::user();
        $ip = request()->ip();
        $fecha = now()->timezone('America/La_Paz')->format('d/m/Y H:i:s');

        // Si quieres registrar solo si hay usuario, usa esto:
        if ($usuario == null) return;

        // Registro en la tabla bitácora
        Bitacora::create([
            'accion' => $accion,
            'descripcion' => $descripcion,
            'nombre_usuario' => $usuario?->nombre_usuario ?? 'Sistema',
            'ip_origen' => $ip,
            'fecha_hora' => $fecha,
            'id_usuario' => $usuario?->id_usuario
        ]);
    }

    public function getReport(Request $request)
    {
        $bitacoras = Bitacora::query()
            ->when($request->usuario, fn($q) => $q->where('nombre_usuario', 'like', "%{$request->usuario}%"))
            ->when($request->tipo, fn($q) => $q->where('accion', $request->tipo))
            ->when($request->fecha, fn($q) => $q->where('fecha_hora', 'like', "%{$request->fecha}%"))
            ->orderByDesc('id_bitacora')
            ->get();

        $formato = $request->input('formato', 'pdf');

        if ($formato === 'excel') {
            return $this->exportExcel($bitacoras);
        } elseif ($formato === 'word') {
            return $this->exportWord($bitacoras);
        } else { // PDF por defecto
            return $this->exportPDF($bitacoras);
        }
    }

    protected function exportPDF($bitacoras)
    {
        $pdf = PDF::loadView('pages.gestion.reportes.bitacoraPDF', compact('bitacoras'));
        return $pdf->download('reporte_bitacora.pdf');
    }

    protected function exportExcel($bitacoras)
    {
        return Excel::download(new BitacoraExport($bitacoras), 'reporte_bitacora.xlsx');
    }

    protected function exportWord($bitacoras)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Reporte de Bitácora');

        $table = $section->addTable();
        $table->addRow();
        $table->addCell()->addText('Acción');
        $table->addCell()->addText('Descripción');
        $table->addCell()->addText('Usuario');
        $table->addCell()->addText('IP');
        $table->addCell()->addText('Fecha y Hora');

        foreach ($bitacoras as $b) {
            $table->addRow();
            $table->addCell()->addText($b->accion);
            $table->addCell()->addText($b->descripcion);
            $table->addCell()->addText($b->nombre_usuario);
            $table->addCell()->addText($b->ip_origen);
            $table->addCell()->addText($b->fecha_hora);
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile, 'Word2007');
        return response()->download($tempFile, 'reporte_bitacora.docx')->deleteFileAfterSend(true);
    }
}
