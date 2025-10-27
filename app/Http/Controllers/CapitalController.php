<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capital;

class CapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capital = Capital::all();
        return view('capital.index', [
            'capital' => $capital
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->capital_id);
        $request->validate([
                    'capital' => ['numeric'],
                    'risk_per_trade' => ['numeric'],
                ]);

        if($request->capital_id){
            // dd('1');
            $capital = Capital::findOrFail($request->capital_id);
            $capital->update($request->all());
        }else{
            // dd('2');
            Capital::create([
                'user_id' => auth()->id(),
                'capital' => $request->capital,
                'risk_per_trade' => $request->risk_per_trade
            ]);
        }
        // dd('3');
        return redirect()->back()->with('status', "Your capital updated successfully");
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
    public function edit(Capital $capital)
    {
        // dd($capital->id);
        return view('capital.edit', [
            'capital' => $capital
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capital $capital)
    {
        $request->validate([
                    'capital' => ['numeric'],
                    'risk_per_trade' => ['numeric',]
                ]);

        $capital->update($request->all());
        return redirect()->route('capital.index')->with('status', 'Your capital updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capital $capital)
    {
        $capital->delete();
        return redirect()->route('capital.index')->with('status', 'Your capital deleted successfully!');
    }
}
