<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = \config()->get('settings.pagination_limit');
        $withdrawals = Withdrawal::with(['user', 'gateway', 'gateway.single_currency'])
        ->where(function($query) use($request){
            if($request->has('status')){
                $query->where('status', $request->status);
            }
        })->latest()->paginate($limit);

        return Inertia::render('Withdrawals/Index', [
            'withdrawals' => $withdrawals,
            'statuses' => $request->status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $withdrawal = Withdrawal::with(['user', 'gateway', 'gateway.single_currency'])->where('id', $id)->first();
        return Inertia::render('Withdrawals/Edit', [
            'withdrawal' => $withdrawal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        try{
            DB::beginTransaction();
            $withdrawal->status = $request->status;
            $withdrawal->save();
            $withdrawal->user->transactions()->create([
                'amount' => $withdrawal->final_amount,
                'trx'    => getTrx(),
                'trx_type'=> '-',
                'remark' => 'withdraw',
                'details' => $withdrawal->final_amount . " USDT transfered to " . $withdrawal->user->username,
                'from' => auth()->user()->id,
                'to' => $withdrawal->user->id,
                'gas_price' => 0,
                'status' => 1,
                'charge' => $withdrawal->charge,
            ]);
            DB::commit();
            return redirect()->route('withdrawals.index');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
