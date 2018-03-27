<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        return Exercise::all();
    }

    public function show(Exercise $exercise)
    {
        return $exercise;
    }

    public function store(Request $request)
    {
        // needs validation

        $exercise = Exercise::create($request->all());

        return response()->json($exercise, 201);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $exercise->update($request->all());

        return response()->json($exercise, 200);
    }

    public function delete(Exercise $exercise)
    {
        $exercise->delete();

        return response()->json(null, 204);
    }
}
