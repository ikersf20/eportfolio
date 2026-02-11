<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CicloFormativo;
use Illuminate\Http\Request;
use App\Http\Resources\CicloFormativoResource;
use App\Models\FamiliaProfesional;
use Illuminate\Support\Facades\Gate;

class CicloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $query = CicloFormativo::where('familia_profesional_id', $familiaProfesional->id);
        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        return CicloFormativoResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FamiliaProfesional $familiaProfesional)
    {


        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|unique:ciclos_formativos,codigo|string|max:50',
            'grado' => 'required|string|in:BÁSICA,G.M.,G.S.,C.E. (G.M.),C.E. (G.S.),basico,medio,superior',
        ]);
        //abort_if ($request->user()->cannot('create', CicloFormativo::class), 403);

        $cicloFormativo = json_decode($request->getContent(), true);

        $cicloFormativo['familia_profesional_id'] = $familiaProfesional->id;
        abort_if($request->user()->cannot('create', CicloFormativo::class), 403);
        $cicloFormativo = CicloFormativo::create($cicloFormativo);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        return new CicloFormativoResource($cicloFormativo);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if($request->user()->cannot('update', $cicloFormativo), 403);
        $cicloFormativoData = json_decode($request->getContent(), true);
        $cicloFormativo->update($cicloFormativoData);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if($request->user()->cannot('delete', $cicloFormativo), 403);
        try {
            $cicloFormativo->delete();
            return response()->json([
                'message' => 'CicloFormativo eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
