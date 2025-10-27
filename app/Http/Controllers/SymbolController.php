<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symbol;


class SymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symbols = Symbol::orderBy('id', 'desc')->get(); 

        return view('symbol.index', [
            'symbols' => $symbols
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('symbol.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.Symbol::class],
        ]);

        $symbol = Symbol::create([
            'name' => $request->name,
        ]);
         return redirect()->route('symbol.index')->with('status', 'Symbol added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $symbol = Symbol::find($id);
        // return print_r($symbol);
        return view('symbol.edit', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symbol $symbol)
    {
        // 1. Validation: Ensure the data is valid before updating (VERY IMPORTANT!)
        $request->validate([
            'name' => 'required|string|max:255|unique:symbols,name,' . $symbol->id, // Exclude current ID from unique check
        ]);

        // 2. Update the Model instance with the new data

        $symbol->update($request->all()); 

        // 3. Redirect back to the index page with a success message
        return redirect()->route('symbol.index')->with('status', 'Symbol updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symbol $symbol)
    {
        // 1. ລຶບ Model ອອກຈາກຖານຂໍ້ມູນ
        $symbol->delete();

        // 2. ກັບໄປຫາໜ້າລາຍການພ້ອມຂໍ້ຄວາມສຳເລັດ
        return redirect()->route('symbol.index')->with('status', 'Symbol deleted successfully!');
    }
}
