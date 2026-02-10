<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ModuloFormativo;
use App\Http\Resources\ModuloFormativoResource;
use Illuminate\Http\Request;
use App\Models\CicloFormativo;
use App\Models\User;

class ModuloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CicloFormativo $cicloFormativo)
    {
        $query = ModuloFormativo::where('ciclo_formativo_id', $cicloFormativo->id);

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        return ModuloFormativoResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')->paginate($request->per_page)
        );
    }
    public function modulosImpartidos(Request $request)
    {
        $user = $request->user();

        $modulos = ModuloFormativo::where('docente_id', $user->id)
            ->orderBy('nombre', 'asc')
            ->get();

        return ModuloFormativoResource::collection($modulos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CicloFormativo $cicloFormativo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string',
            'horas_totales' => 'required|integer|min:1',
            'curso_escolar' => 'required|string|max:255',
            'centro' => 'required|string|max:255',
        ]);

        $moduloFormativo = json_decode($request->getContent(), true);
        $moduloFormativo['ciclo_formativo_id'] = $cicloFormativo->id;
        if (!isset($moduloFormativo['docente_id'])) {
            $moduloFormativo['docente_id'] = $request->user()->id;
        }
        $moduloFormativo = ModuloFormativo::create($moduloFormativo);

        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Display the specified resource.
     */
    public function show(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        $moduloFormativoData = json_decode($request->getContent(), true);
        $moduloFormativo->update($moduloFormativoData);

        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        try {
            $moduloFormativo->delete();
            return response()->json([
                'message' => 'ModuloFormativo eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
