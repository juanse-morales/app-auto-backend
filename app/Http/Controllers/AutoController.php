<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auto;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autos = Auto::all();
        return view('autos.index', compact('autos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'modelo' => 'required|max:255',
            'marca' => 'required|max:255',
        ]);

        Auto::create($request->all());
        
        return redirect()->route('autos.index')
            ->with('success', 'Auto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auto = Auto::find($id);
        return view('autos.show', compact('auto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'modelo' => 'required|max:255',
            'marca' => 'required|max:255',
        ]);
        
        $auto = Auto::find($id);
        $auto->update($request->all());
        
        return redirect()->route('autos.index')
            ->with('success', 'Auto updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auto = Auto::find($id);
        $auto->delete();
        
        return redirect()->route('autos.index')
            ->with('success', 'Auto deleted successfully');
    }

    /**
     * Show the form for editing the specified auto.
     *
     * @param  int  $id
     * @return IlluminateHttpResponse
     */
    public function edit($id)
    {
        $auto = Auto::find($id);
        return view('autos.edit', compact('auto'));
    }
}
