<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CitaRechazadaResource;
use App\Models\CitaRechazada;

class CitaRechazadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citasRechazadas = CitaRechazada::with('usuario')->get();

        return Inertia::render('Admin/Citas/Rechazadas', [
            'citasRechazadas' => CitaRechazadaResource::collection($citasRechazadas),
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
        //
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
