<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Auto;
use Illuminate\Support\Facades\Validator;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autos = Auto::all();
        return response()->json($autos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25|unique:autos',
            'modelo' => 'required|max:25',
            'marca' => 'required|max:25',
            'pais' => 'max:45',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $auto = Auto::create($request->all());
        
        if (!$auto) {
            $data = [
                'message' => 'Error al crear el auto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'auto' => $auto,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auto = Auto::find($id);

        if (!$auto) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'auto' => $auto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $auto = Auto::find($id);

        if (!$auto) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25|unique:autos',
            'modelo' => 'required|max:25',
            'marca' => 'required|max:25',
            'pais' => 'required|max:45'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $auto->name = $request->name;
        $auto->modelo = $request->modelo;
        $auto->marca = $request->marca;
        $auto->pais = $request->pais;

        $auto->save();

        $data = [
            'message' => 'Auto actualizado',
            'auto' => $auto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auto = Auto::find($id);

        if (!$auto) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $auto->delete();

        $data = [
            'message' => 'Auto eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $auto = Auto::find($id);

        if (!$auto) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25|unique:autos',
            'modelo' => 'required|max:25',
            'marca' => 'required|max:25',
            'pais' => 'required|max:45'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $auto->name = $request->name;
        }

        if ($request->has('modelo')) {
            $auto->modelo = $request->modelo;
        }

        if ($request->has('marca')) {
            $auto->marca = $request->marca;
        }

        if ($request->has('pais')) {
            $auto->pais = $request->pais;
        }

        $auto->save();

        $data = [
            'message' => 'Auto actualizado',
            'auto' => $auto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

}
