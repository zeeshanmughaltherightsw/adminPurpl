<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = \config()->get('settings.pagination_limit');
        $users = User::select(['name', 'username', 'phone_no', 'email', 'status', 'id'])->where(function($query){
            if(request()->keyword){
                $query->where('name', 'LIKE', '%' . request()->keyword .'%')
                ->orWhere('username', 'LIKE', '%' . request()->keyword .'%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword .'%')
                ->orWhere('phone_no', 'LIKE', '%' . request()->keyword .'%');
            }
            if(request()->status){
                $query->where('name', 'LIKE', '%' . request()->keyword .'%');
            }
        })->where('user_type', 'user')->paginate($limit);
        return Inertia::render('Users/Index', [
            'users' => $users,
            'searchKeyword' => request()->keyword
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
        $user = User::withSum([
            'transactions' => function ($query) {
                $query->where('remark', 'deposit');
        }], 'amount')
        ->withSum('withdrawals', 'amount')
        ->with(['media','plan', 'transactions', 'referrals', 'referredBy' => function($q){ $q->select(['id', 'name']); }])
        ->withCount(['referrals', 'transactions'])->findOrFail($id);

        return Inertia::render('Users/Details', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'phone_no' => 'required',
            'email' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->back();
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

    public function transactions($id)
    {
        $limit = \config()->get('settings.pagination_limit');
        $transactions = Transaction::whereHas('user', function($query) use($id){
            $query->where('id', $id);
        })->paginate($limit);
        return Inertia::render('Users/Transactions', [
            'transactions' => $transactions
        ]);
    }

    public function changeStatus($id, $status)
    {
        User::find($id)->update('status', $status);
    }

    public function subscribePlan(Request $request, User $user)
    {
        $request->validate([
            'plan_id' => 'required'
        ]);
        try{
            DB::beginTransaction();
            $amount = $request->amount;
            $user->investment += $amount;
            $user->save();
            $transaction = $user->transactions()->create([
                'amount' => $amount,
                'trx' => getTrx(),
                'gas_price' => $request->gas_price,
                'trx_type' => '+',
                'details' => "Deposit",
                'remark' => "Deposit",
                'status' => $request->status ? 1 : 0,
                'from' => $request->from,
                'to' => $request->to,
            ]);
            // http://localhost:8000/save-transactions?gas_price=21596&trx=0x893e5721e7d65431caf38da7871cded5ffe2e42cdb8fd658e21765b22d5a225f&amount=1000000&status=true&from=0xadc95259bf19af8cea70426af1ae5db4e71167f1&to=0xdac17f958d2ee523a2206206994597c13d831ec7
            $user = upgradeMembership($amount, $user);
            if($user && $user->plan_id){
                $transaction->commissionRecord()->create([
                    'amount' => $amount,
                    'user_id' => $user->id,
                ]);
    
                addCommissionToReferals($user, $transaction);
            }

            DB::commit();
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
