<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultaResource;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $consultas = Consulta::all();
        return Inertia::render('Consultar/Consultar', [
            'consulta' => ConsultaResource::collection($consultas)
        ]);
    }

    public function todoc(): Response
    {
        $consultas = Consulta::with('usuario')->get();
        return Inertia::render('Consultar/Consultas', [
            'consultas' => ConsultaResource::collection($consultas)
        ]);
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
            'consulta' => 'required|max:255',
        ]);

        $consulta = new Consulta;
        $consulta->usuario_id = auth()->id(); // Asegúrate de que el usuario esté autenticado
        $consulta->mensaje = $request->consulta;
        $consulta->save();

        return redirect()->route('dashboard')->with('success', 'Consulta creada con éxito.');
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
