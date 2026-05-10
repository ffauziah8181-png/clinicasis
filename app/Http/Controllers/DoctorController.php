<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return response()->json(Doctor::with('specialist')->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'license_number' => 'required|string',
            'specialist_id' => 'required|exists:specialists,id',
        ]);
        $doctor = Doctor::create($request->all());
        return response()->json($doctor, 201);
    }

    public function show($id)
    {
        $doctor = Doctor::with('specialist')->find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($doctor, 200);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $doctor->update($request->all());
        return response()->json($doctor, 200);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $doctor->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}