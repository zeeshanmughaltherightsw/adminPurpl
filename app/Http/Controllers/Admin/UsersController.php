<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

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
        $user = User::with(['media','plan', 'referredBy' => function($q){ $q->select(['id', 'name']); }])->withCount(['referrals', 'transactions'])->findOrFail($id);
        // return $user;
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
}
