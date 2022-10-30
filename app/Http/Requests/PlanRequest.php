<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $data = [];
        switch(request()->method()){
            case "POST":
               $data = [
                    'name' => 'required | unique:plans',
                    'price' => 'required | min:0',
                    'amount_returns' => 'required | min:0',
                ];
            break;
            case "PUT":
                $data = [
                    'name' => 'required | unique:plans,name, ' . request()->id,
                    'price' => 'required | min:0',
                    'amount_returns' => 'required | min:0',
                ];
            break;
        }
        return $data;
    }
}
