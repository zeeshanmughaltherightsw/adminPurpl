<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use Exception;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = \config()->get('settings.pagination_limit');
        $plans = Plan::where(function($query){
            if(request()->keyword){
                $query->where('name', 'LIKE', '%' . request()->keyword .'%');
            }
        });
        if(request()->ajax()){
            return $plans->get();
        }
        
        return Inertia::render('Plan/Index', [
            'plans' => $plans->paginate($limit),
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
    public function store(PlanRequest $request)
    {
        try{
            Plan::create($request->all());
            flash('Plan created successfully', 'success');
            return redirect()->back();
        }catch(Exception $e){
            flash($e->getMessage(), 'danger');
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
    public function update(PlanRequest $request, $id)
    {
        try{
            Plan::findOrFail($id)->update($request->all());
            flash('Plan updated successfully', 'success');
            return redirect()->back();
        }catch(Exception $e){
            flash($e->getMessage(), 'danger');
            return redirect()->back();
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

    public function changeStatus(Plan $plan)
    {
        $plan->status = $plan->status ? 0 : 1;
        $plan->save();
        return redirect()->route('manage-plan.index');
    }
}
