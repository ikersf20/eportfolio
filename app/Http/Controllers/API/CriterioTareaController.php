<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriterioTareaResource;
use App\Models\CriterioEvaluacion;
use App\Models\CriterioTarea;
use Illuminate\Http\Request;

class CriterioTareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CriterioEvaluacion $criterioEvaluacion)
    {
        /**
        *$query = CriterioTarea::query();
        *if ($query) {
        *    $query->orWhere('id', 'like', '%' . $request->q . '%');
        *}

        *return CriterioTareaResource::collection(
        *    $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
        *    ->paginate($request->per_page)
        *);
        */
        return CriterioTareaResource::collection(
            CriterioTarea::where('actividad_id', $criterioEvaluacion->id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource_pn storage.
     */
        public function store(Request $request)
    {
        $criterioTareaData = json_decode($request->getContent(), true);

        $criterioTarea = CriterioTarea::create($criterioTareaData);

        return new CriterioTareaResource($criterioTarea);
    }

    /**
     * Display the specified resource.
     */
    public function show(CriterioTarea $criterioTarea)
    {
        return new CriterioTareaResource($criterioTarea);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriterioTarea $criterioTarea)
    {
        $criterioTareaData = json_decode($request->getContent(), true);
        $criterioTarea->update($criterioTareaData);

        return new CriterioTareaResource($criterioTarea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CriterioTarea $criterioTarea)
    {
        try {
            $criterioTarea->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
