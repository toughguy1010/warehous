<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    //
    public function index()
    {
        $units = Unit::paginate(5);
        $data['units'] = $units;
        return view('units.index', $data);
    }
    public function upsert(Request $request, $id = null)
    {
        if ($id !== null) {
            $unit = Unit::findOrFail($id);
        } else {
            $unit = null;
        }
        $data['unit'] = $unit;
        return view('units.upsert', $data);
    }
    public function upsertStore(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            if ($id !== null) {
                $unit = Unit::findOrFail($id);
            } else {
                $unit = new Unit();
            }
            $unit->name = $request->name;
            if ($unit->save()) {
                session()->flash('success', $id ? 'Unit updated successfully' : 'Unit created successfully');
                return redirect()->route('unit.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving the unit');
            return back();
        }
    }
    public function delete($id)
    {
        try {
            $unit = Unit::findOrFail($id);
            $unit->delete();

            // Store a success message in the session
            session()->flash('success', 'Unit deleted successfully');
            return redirect()->route('unit.index');
        } catch (\Exception $e) {
            // Store an error message in the session
            session()->flash('error', 'An error occurred while deleting the unit');
            return redirect()->route('unit.index');
        }
    }
}
