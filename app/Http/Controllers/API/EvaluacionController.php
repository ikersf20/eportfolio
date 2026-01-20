<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluacionResource;
use App\Models\Evaluacion;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query =    Evaluacion::query();
        if ($query) {
            $query->orWhere('nombre', 'like', '%' . $request->q . '%');
        }

        return EvaluacionResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
            ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource_pn storage.
     */
        public function store(Request $request)
    {
        $evaluacionData = json_decode($request->getContent(), true);

        $evaluacion = Evaluacion::create($evaluacionData);

        return new EvaluacionResource($evaluacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluacion $evaluacion)
    {
        return new EvaluacionResource($evaluacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
        $evaluacionData = json_decode($request->getContent(), true);
        $evaluacion->update($evaluacionData);

        return new EvaluacionResource($evaluacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluacion $evaluacion)
    {
        try {
            $evaluacion->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}