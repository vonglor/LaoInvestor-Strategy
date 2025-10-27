<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Strategies;
use App\Models\Symbol;
use Illuminate\Validation\Rule;
use App\Repositories\SymbolRepository;
use App\Repositories\CapitalRepository;

class StrategiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $strategies = Strategies::where('user_id', auth()->id())->orderBy('id', 'desc')->get(); 

        return view('strategies.index', [
            'strategies' => $strategies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SymbolRepository $symbolRepository)
    {
        $symbols = $symbolRepository->getSymbols();

        return view('strategies.create', ['symbols' => $symbols]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'symbol_id' => ['required'],
            'rr' => ['required', 'numeric'], 
            'timeframe' => ['required', 'string', ]
        ]);

        $strategies = Strategies::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'symbol_id' => $request->symbol_id,
            'rr' => $request->rr,
            'timeframe' => $request->timeframe

        ]);
         return redirect()->route('strategies.index')->with('status', 'Strategy added successfully!');
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

        $strategy = Strategies::find($id);
        // return print_r($symbol);
        $symbols = Symbol::where('id', '!=', $strategy->symbol_id)->get();

        return view('strategies.edit', [
            'strategy' => $strategy,
            'symbols' => $symbols,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validation: Ensure the data is valid before updating (VERY IMPORTANT!)
        $request->validate([
            'name' => [
            'required', 
            'string', 
            'max:255',
        ],
        // ... ຢືນຢັນ Rule ອື່ນໆ
        'symbol_id' => ['required', 'integer'], // ໃຫ້ແນ່ໃຈວ່າມີ 'integer'
        'rr' => ['required', 'numeric'], 
        'timeframe' => ['required', 'string'],
        ]);
        // dd($strategies);
        $strategy = Strategies::findOrFail($id);
        $strategy->update($request->all());

        return redirect()->route('strategies.index')->with('status', 'Strategy updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // 1. ຄົ້ນຫາ Record ດ້ວຍຕົນເອງ
        $strategies = Strategies::findOrFail($id); 

        // 2. ລຶບ Record ທີ່ຖືກດຶງມາ
        $strategies->delete();
        return redirect()->route('strategies.index')->with('status', 'Strategy deleted successfully!');
    }


    public function changeStatus(Request $request, Strategies $strategies) 
    {
        // 1. Validation (ຢືນຢັນຄ່າ status ທີ່ຕ້ອງການປ່ຽນ)
        // echo $request->status; exit;
        $request->validate([
            'status' => 'required|in:win,loss', // ໃຫ້ແນ່ໃຈວ່າຄ່າທີ່ສົ່ງມາຖືກຕ້ອງ
        ]);

        // 2. ອັບເດດສະເພາະຖັນ 'status'
        $strategies->update([
            'status' => $request->status, 
        ]);
    

        // 3. Redirect
        return redirect()->route('strategies.index')->with('status', 'Strategy status updated to ' . $request->status . '!');
    }

    public function backtest(CapitalRepository $capitalRepository, string $id)
    {
        // dd(auth()->id());
        $strategies = Strategies::findOrFail($id);

        $capitalRecord = $capitalRepository->getCapital(auth()->id());
        // dd($capitalRecord->risk_per_trade);
        // 3. ກໍານົດຄ່າ Capital ທີ່ສົ່ງໄປຫາ View
        if ($capitalRecord) {
            // ຖ້າມີຂໍ້ມູນ, ໃຊ້ຂໍ້ມູນຈາກ Model ໂດຍກົງ (Laravel ຈະປ່ຽນເປັນ Array ໃຫ້)
            $capitalData = $capitalRecord->toArray(); 
        } else {
            // ຖ້າບໍ່ມີ, ໃຊ້ຄ່າ default
            $capitalData = [
                'id' => '',
                'capital' => 0,
                'risk_per_trade' => 0
            ];
        }

        return view('strategies.backtest', [
                'strategies' => $strategies,
                'capital' => $capitalData
            ]);
        
    }

    public function timespan(Request $request, Strategies $strategies)
    {
        // dd($strategies);
        //  $strategies->update([
        //     'status' => $request->status, 
        // ]);

        $strategies->update($request->all());
        return redirect()->back()->with('status', "Time span updated successfully");
        
    }

    public function win(Strategies $strategies) 
    {
    
        $strategies->update([
            'win' => $strategies->win+1, 
        ]);

        return redirect()->back()->with('status', "Win status recorded successfully!");
    
    }

     public function loss(Strategies $strategies) 
    {
    
        $strategies->update([
            'loss' => $strategies->loss+1, 
        ]);

        return redirect()->back()->with('status', "Loss status recorded successfully!");
    
    }
}
