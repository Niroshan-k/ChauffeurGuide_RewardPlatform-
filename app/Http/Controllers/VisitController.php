<?php
// app/Http/Controllers/VisitController.php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Guide;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'guide_id' => 'required|exists:guides,id',
            'visit_date' => 'required|date',
            'pax_count' => 'required|integer|min:0',
        ]);

        $visit = Visit::create($request->all());

        return response()->json(['message' => 'Visit added.', 'visit' => $visit]);
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $visit->update($request->only(['visit_date', 'pax_count']));

        return response()->json(['message' => 'Visit updated.', 'visit' => $visit]);
    }

    public function destroy($id)
    {
        Visit::destroy($id);
        return response()->json(['message' => 'Visit deleted.']);
    }
}
