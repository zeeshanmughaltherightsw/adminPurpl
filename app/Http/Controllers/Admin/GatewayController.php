<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Gateway;
use Illuminate\Http\Request;
use App\Models\GatewayCurrency;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $limit = \config()->get('settings.pagination_limit');
        $gateways = Gateway::whereType($type)->with(['media'])->where(function($query){
            if(request()->keyword){
                $query->where('name', 'LIKE', '%' . request()->keyword .'%');
            }
        })->where('is_manual', 1)->paginate($limit);
        return Inertia::render('Gateway/Index',[
            'gateways' => $gateways,
            'searchKeyword' => request()->keyword,
            'type' => $type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return Inertia::render('Gateway/Create', [
            'type' => $type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, Request $request)
    {
        try{
            DB::beginTransaction();
            $last_method = Gateway::whereType($type)->manual()->latest()->first();
            $method_code = 1000;
            if ($last_method) {
                $data['method_code'] = $last_method->code + 1;
            }
            $method = Gateway::create([
                'code' => $method_code,
                'name' => $request->name,
                'slug' => strtolower(trim(str_replace(' ','_',$request->name))),
                'status' => 0,
                'parameters' => json_encode([]),
                'extra' => json_encode(['delay' => $request->delay]),
                'input_form' => json_encode($request->userData),
                'supported_currencies' => json_encode([$request->currency]),
                'crypto' => 0,
                'description' => $request->instruction,
                'is_manual' => 1,
                'status' => true,
                'type' => $request->type,
            ]);

            $gatewatCurrency = $method->single_currency()->save(new GatewayCurrency([
                'name' => $request->name,
                'code' => $method_code,
                'currency' => $request->currency,
                'symbol' => '',
                'min_amount' => $request->min_limit,
                'max_amount' => $request->max_limit,
                'fixed_charge' => $request->fixed_charge,
                'percentage_charge' => $request->percentage_charge,
                'rate' => $request->rate,
                'gateway_parameter' => isset($input_form) ? json_encode($input_form) : "[]",
            ]));

            if ($request->hasFile('image')) {
                $filename = '';
                $path = imagePath()['gateway']['path'];
                $size = imagePath()['gateway']['size'];
                $filename = uploadImage($request->image, $path, $size);
                //Save method image
                $method->media()->create([
                    'name' => $method->name,
                    'file_name' => $path . '/' . $filename,
                    'size' => $size,
                    'mime_type' => $request->file('image')->getClientOriginalExtension(),
                    // 'type' => 'image',
                ]);
                
                $gatewatCurrency->media()->create([
                    'name' => $gatewatCurrency->name,
                    'file_name' => $path . '/' . $filename,
                    'size' => $size,
                    'mime_type' => $request->file('image')->getClientOriginalExtension(),
                    // 'type' => 'image',
                ]);
            }
            DB::commit();
            flash($method->name . " Manual Gateway has been added." , 'success');
            return redirect()->route('gateway.index', $type);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function show($type, Gateway $gateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $gateway)
    {
        $gateway = Gateway::with(['single_currency', 'media'])->findOrFail($gateway);
        return Inertia::render('Gateway/Create', [ 'gateway' => $gateway ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function update($type, Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $method = Gateway::findOrFail($id);
            $method->update([
                'name' => $request->name,
                'slug' => strtolower(trim(str_replace(' ','_',$request->name))),
                'parameters' => json_encode([]),
                'extra' => json_encode(['delay' => $request->delay]),
                'input_form' => json_encode($request->userData),
                'supported_currencies' => json_encode([$request->currency]),
                'crypto' => 0,
                'description' => $request->instruction,
                'is_manual' => 1,
                'status' => true
            ]);

            $gatewatCurrency = $method->single_currency()->update([
                'name' => $request->name,
                'currency' => $request->currency,
                'symbol' => '',
                'min_amount' => $request->min_limit,
                'max_amount' => $request->max_limit,
                'fixed_charge' => $request->fixed_charge,
                'percentage_charge' => $request->percentage_charge,
                'rate' => $request->rate,
                'gateway_parameter' => isset($input_form) ? json_encode($input_form) : "[]",
            ]);

            if ($request->hasFile('image')) {
                $filename = '';
                $path = imagePath()['gateway']['path'];
                $size = imagePath()['gateway']['size'];
                $filename = uploadImage($request->image, $path, $size, $method->media->path);
                //Save method image
                $method->media()->create([
                    'path' => $path . '/' . $filename,
                    'size' => $size,
                    'mime_type' => $request->file('image')->getClientOriginalExtension(),
                    'type' => 'image',
                    'is_external' => 0
                ]);
                
                $gatewatCurrency->media()->create([
                    'path' => $path . '/' . $filename,
                    'size' => $size,
                    'mime_type' => $request->file('image')->getClientOriginalExtension(),
                    'type' => 'image',
                    'is_external' => 0
                ]);
            }

            DB::commit();
            flash($method->name . " Manual Gateway has been added." , 'success');
            return redirect()->route('gateway.index', $type);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gateway  $gateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gateway $gateway)
    {
        //
    }
}
