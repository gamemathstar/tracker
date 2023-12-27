<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Request $request)
    {
        $sectors = Sector::get();
        return view('pages.sector.index',compact('sectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sectors|max:255',
            'description' => 'required|max:255',
            // Add other validation rules as needed
        ]);

        Sector::create($request->all());

        return redirect()->route('sectors.index')->with('success', 'Sector created successfully');
    }

    public function show(Request $request,$id,$comm_id=null)
    {
        $sector = Sector::find($id);
        $commitments = $sector->__commitments()->get();
        return view('pages.sector.view', compact('sector','commitments','comm_id'));
    }

    public function edit(Sector $sector)
    {
        return view('sectors.edit', compact('sector'));
    }

    public function update(Request $request)
    {
        $sector = Sector::find($request->id);
        $request->validate([
            'name' => 'required|unique:sectors,name,' . $sector->id . '|max:255',
            'description' => 'required|max:255',
            // Add other validation rules as needed
        ]);

        $sector->update($request->all());

        return redirect()->route('sectors.index')->with('success', 'Sector updated successfully');
    }

    public function destroy(Sector $sector)
    {
        $sector->delete();

        return redirect()->route('sectors.index')->with('success', 'Sector deleted successfully');
    }
}
