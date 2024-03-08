<?php

namespace App\Http\Controllers;

use App\Models\Suit;
use Illuminate\Http\Request;

class SuitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Suit::paginate(10)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image.*'=> 'required|image|mimes:jpeg,png,jpg',
            'fabric_name' => 'required',
            'type_id' => 'required',

        ]);
        $imageName = time().'_'.$request->user()->id.$request->image->getClientOriginalName();
        $request->image->move(public_path('images'),$imageName);
        $suit = Suit::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'fabric_name' => $request->fabric_name,
            'type_id' => $request->type_id,
            'user_id' => $request->user()->id,
        ]);
        return response()->json(['data' => $suit]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suit = Suit::find($id);
        if($suit){
            return response()->json(['data' => $suit]);
        }
        return response()->json(['message' => 'Suit not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $suit = Suit::find($id);
        // if($suit){
        //     $suit->name = $request->name ?? $suit->name;
        //     $suit->description = $request->description ?? $suit->description;
        //     $suit->fabric_name = $request->fabric_name ?? $suit->fabric_name;
        //     $suit->type_id = $request->type_id ?? $suit->type_id;

        //     if($request->hasFile('image')){
        //         $imageName = time().'_'.$request->user()->id.$request->image->getClientOriginalName();
        //         $request->image->move(public_path('images'),$imageName);
        //         $suit->image = $imageName ;
        //         return response()->json(['data' => $suit]);
        //     }
            
        //     $suit->update();
        //     return response()->json(['data' => $suit]);
        // }
        // return response()->json(['message' => 'Suit not found'], 404);
    }
    public function updateSuit(Request $request , string $id)
    {
        
        $suit = Suit::find($id);
        if($suit){
            $suit->name = $request->name ?? $suit->name;
            $suit->description = $request->description ?? $suit->description;
            $suit->fabric_name = $request->fabric_name ?? $suit->fabric_name;
            $suit->type_id = $request->type_id ?? $suit->type_id;

            if($request->hasFile('image')){
                $imageName = time().'_'.$request->user()->id.$request->image->getClientOriginalName();
                $request->image->move(public_path('images'),$imageName);
                $suit->image = $imageName ;
                
            }
            
            $suit->update();
            return response()->json(['data' => $suit]);
        }
        return response()->json(['message' => 'Suit not found'], 404);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suit = Suit::find($id);
        if($suit){
            $suit->delete();
            return response()->json(['message' => 'Suit deleted']);
        }
        return response()->json(['message' => 'Suit not found'], 404);
    }
}
