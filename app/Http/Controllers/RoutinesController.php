<?php

namespace App\Http\Controllers;

use App\Routine;
use Illuminate\Http\Request;

class RoutinesController extends Controller
{
    public function index()
    {
        return Routine::all();
    }

    public function show(Routine $routine)
    {
        return $routine;
    }

    public function store(Request $request)
    {
        $routine = Routine::create($request->all());

        return response()->json($routine, 201);
    }
    
     public function update(Request $request, Routine $routine)
    {
        $routine->update($request->all());
        
        return response()->json($routine, 200);
    }
    
    public function delete(Routine $routine)
    {
        $routine->delete();

        return response()->json(null, 204);
    }
}
