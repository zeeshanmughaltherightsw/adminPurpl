<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Exception;
use App\Models\PlanLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = PlanLevel::with('plan')->get();
        $plans = Plan::where('status', 1)->get();
        return Inertia::render('Commission/Index', [
            'levels'    => $level,
            'plans'     => $plans
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
        try{
            $this->validate($request, [
                'level*' => 'required|integer|min:1',
                'percent*' => 'required|numeric',
            ]);
            
            PlanLevel::where('plan_id', $request->plan_id)->delete();
            
            DB::beginTransaction();
            for ($i = 0; $i < count($request->level); $i++){
                PlanLevel::create([
                    'level' => $i + 1,
                    'commission' => $request->percent[$i],
                    'status' => 1,
                    'plan_id' => $request->plan_id
                ]);
            }
            DB::commit();
            flash('Referral Commission Setting Updated Successfully' , 'success');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollBack();
            flash($e->getMessage() , 'error');
            return redirect()->back();
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
