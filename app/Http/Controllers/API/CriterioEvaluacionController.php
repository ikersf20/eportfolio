<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriterioEvaluacionResource;
use App\Models\CriterioEvaluacion;
use App\Models\ResultadoAprendizaje;
use Illuminate\Http\Request;

class CriterioEvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ResultadoAprendizaje $resultadoAprendizaje)
    {

        $query = CriterioEvaluacion::query()->where('resultado_aprendizaje_id', $resultadoAprendizaje->id);
        if ($request->has('search')) {
            $query->where('descripcion', 'like', '%' . $request->search . '%');
        }

        return CriterioEvaluacionResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
            ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource_pn storage.
     */
        public function store(Request $request, ResultadoAprendizaje $resultadoAprendizaje)
    {
        $request->validate([
            'codigo' => 'required|string|max:50',
            'descripcion' => 'required|string',
        ]);

        $criterioEvaluacionData = json_decode($request->getContent(), true);
        $criterioEvaluacionData['resultado_aprendizaje_id'] = $resultadoAprendizaje->id;

        $criterioEvaluacion = CriterioEvaluacion::create($criterioEvaluacionData);

        return new CriterioEvaluacionResource($criterioEvaluacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(ResultadoAprendizaje $resultadoAprendizaje,CriterioEvaluacion $criterioEvaluacion)
    {
        return new CriterioEvaluacionResource($criterioEvaluacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResultadoAprendizaje $resultadoAprendizaje, CriterioEvaluacion $criterioEvaluacion)
    {
        $criterioEvaluacionData = json_decode($request->getContent(), true);
        $criterioEvaluacion->update($criterioEvaluacionData);

        return new CriterioEvaluacionResource($criterioEvaluacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultadoAprendizaje $resultadoAprendizaje, CriterioEvaluacion $criterioEvaluacion)
    {
        try {
            $criterioEvaluacion->delete();
            return response()->json([
                'message' => 'Criterio de Evaluación eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
