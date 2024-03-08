<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Type::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = Type::create($request->all());
        return response()->json(['data' => $type], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = Type::find($id);
        if($type){
            return response()->json(['data' => $type]);
        }
        return response()->json(['message' => 'Type not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = Type::find($id);
        if($type){
            $type->update($request->all());
            return response()->json(['data' => $type]);
        }
        return response()->json(['message' => 'Type not found'], 404);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Type::find($id);
        if($type){
            $type->delete();
            return response()->json(['message' => 'Type deleted']);
        }
        return response()->json(['message' => 'Type not found'], 404);
    }
}
