<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\CitaAceptada;
use Illuminate\Http\Request;
use App\Models\CitaPendiente;
use App\Models\CitaRechazada;
use App\Http\Controllers\Controller;
use App\Http\Resources\CitaAceptadaResource;
use App\Http\Resources\CitaPendienteResource;
use App\Http\Resources\CitaRechazadaResource;

class CitaPendienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        $usuarioId = auth()->user()->id;

        $citasPendientes = CitaPendiente::all()->mapWithKeys(function ($cita) {
            $key = $cita->fecha->format('Y-m-d') . '-' . $cita->hora->format('H:i');
            return [$key => true];
        });

        $citasAceptadas = CitaAceptada::all()->mapWithKeys(function ($cita) {
            $key = $cita->fecha->format('Y-m-d') . '-' . $cita->hora->format('H:i');
            return [$key => true];
        });

        // Obtén la fecha de hace 7 días
        $fechaHaceSieteDias = Carbon::now()->subDays(7);

        // Obtén los id_usuario de las citas pendientes de los últimos 7 días
        $idUsuariosCitasPendientes = CitaPendiente::where('created_at', '>=', $fechaHaceSieteDias)
            ->pluck('usuario_id');

        // Obtén los id_usuario de las citas aceptadas de los últimos 7 días
        $idUsuariosCitasAceptadas = CitaAceptada::where('created_at', '>=', $fechaHaceSieteDias)
            ->pluck('usuario_id');

        // Combina los dos conjuntos de id_usuario
        $idUsuarios = $idUsuariosCitasPendientes->concat($idUsuariosCitasAceptadas)->unique();

        return Inertia::render('Reservar/Reservar', [
            'citasPendientes' => $citasPendientes,
            'citasAceptadas' => $citasAceptadas,
            'idUsuarios' => $idUsuarios,
            'usuarioId' => $usuarioId,
        ]);
    }

    public function pendientes()
    {
        $citasPendientes = CitaPendiente::with('usuario')->get();

        return Inertia::render('Admin/Citas/Pendientes', [
            'citasPendientes' => CitaPendienteResource::collection($citasPendientes),
        ]);
    }

    public function historial(): Response
    {
        $usuarioId = auth()->user()->id;

        $citasPendientes = CitaPendiente::where('usuario_id', $usuarioId)->get();
        $citasAceptadas = CitaAceptada::where('usuario_id', $usuarioId)->get();
        $citasRechazadas = CitaRechazada::where('usuario_id', $usuarioId)->get();

        return Inertia::render('Reservar/Historial', [
            'citasPendientes' => $citasPendientes,
            'citasAceptadas' => $citasAceptadas,
            'citasRechazadas' => $citasRechazadas,
        ]);
    }

    public function aceptarCita(string $id)
    {
        $citaPendiente = CitaPendiente::findOrFail($id);

        // Guarda la cita pendiente como cita aceptada
        $citaAceptada = new CitaAceptada([
            'usuario_id' => $citaPendiente->usuario_id,
            'fecha' => $citaPendiente->fecha,
            'hora' => $citaPendiente->hora,
            'hora_fin' => $citaPendiente->hora_fin,
        ]);

        $citaAceptada->save();
        $citaPendiente->delete();

        return Inertia::location(route('admin.citas.pendientes'));
    }

    public function rechazarCita(string $id)
    {
        $citaPendiente = CitaPendiente::findOrFail($id);

        // Guarda la cita pendiente como cita rechazada
        $citaRechazada = new CitaRechazada([
            'usuario_id' => $citaPendiente->usuario_id,
            'fecha' => $citaPendiente->fecha,
            'hora' => $citaPendiente->hora,
            'hora_fin' => $citaPendiente->hora_fin,
        ]);

        $citaRechazada->save();
        $citaPendiente->delete();

        return Inertia::location(route('admin.citas.pendientes'));
    }


    public function citas()
    {
        return Inertia::render('Admin/Citas/IndexCitas');
    }


    public function comprobantep($id)
    {
        $citaPendiente = new CitaPendienteResource(CitaPendiente::with('usuario')->findOrFail($id));
        $fechaActual = Carbon::now('America/Lima')->toDateString();
        $horaActual = Carbon::now('America/Lima')->toTimeString();
        $estado = 'PENDIENTE';
        $otrosDatos = [
            'fechaActual' => $fechaActual,
            'horaActual' => $horaActual,
            'estado' => $estado,
        ];
        return view('comprobante', ['citaPendiente' => $citaPendiente, 'otrosDatos' => $otrosDatos]);
    }

    public function comprobantea($id)
    {
        $citaAceptada = new CitaAceptadaResource(CitaAceptada::with('usuario')->findOrFail($id));
        $fechaActual = Carbon::now('America/Lima')->toDateString();
        $horaActual = Carbon::now('America/Lima')->toTimeString();
        $estado ='ACEPTADO';
        $otrosDatos = [
            'fechaActual' => $fechaActual,
            'horaActual' => $horaActual,
            'estado' => $estado,
        ];
        return view('comprobante', ['citaPendiente' => $citaAceptada, 'otrosDatos' => $otrosDatos]);
    }

    public function comprobanter($id)
    {
        $citaRechazada = new CitaRechazadaResource(CitaRechazada::with('usuario')->findOrFail($id));
        $fechaActual = Carbon::now('America/Lima')->toDateString();
        $horaActual = Carbon::now('America/Lima')->toTimeString();
        $estado = 'RECHAZADO';
        $otrosDatos = [
            'fechaActual' => $fechaActual,
            'horaActual' => $horaActual,
            'estado' => $estado,
        ];
        return view('comprobante', ['citaPendiente' => $citaRechazada, 'otrosDatos' => $otrosDatos]);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fechaInput' => 'required|date',
            'horaInput' => 'required|date_format:H:i',
            'hora_finInput' => 'required|date_format:H:i|after:hora',
        ]);

        CitaPendiente::create([
            'usuario_id' => auth()->id(),
            'fecha' => $request->fechaInput,
            'hora' => $request->horaInput,
            'hora_fin' => $request->hora_finInput,
        ]);

        return redirect()->route('reserva.index')->with('success', 'Cita pendiente creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
