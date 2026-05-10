<?php
namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index()
    {
        return response()->json(Specialist::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $specialist = Specialist::create($request->all());
        return response()->json($specialist, 201);
    }

    public function show($id)
    {
        $specialist = Specialist::with('doctors')->find($id);
        if (!$specialist) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($specialist, 200);
    }

    public function update(Request $request, $id)
    {
        $specialist = Specialist::find($id);
        if (!$specialist) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $specialist->update($request->all());
        return response()->json($specialist, 200);
    }

    public function destroy($id)
    {
        $specialist = Specialist::find($id);
        if (!$specialist) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $specialist->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}