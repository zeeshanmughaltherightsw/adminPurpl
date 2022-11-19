<?php

use App\Models\User;
use App\Models\PlanLevel;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

function getUserId(){
    $user = \App\Models\User::select('uuid')->orderby('id','DESC')->first();
    if($user){
        $id = explode('AAM',$user->uuid)[1]; 
        if( $id > 99999){
            return "AAM".$id+1;
        }
        return "AAM".sprintf('%05u', $id+1);
    }
    return "AAM".sprintf('%05u', 1);
}


function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Get logged in user role
 * @return object
 */
function getRole($user)
{

    return $user && $user->roles ? $user->roles[0] : NULL;
}

/**
 * Get role permissions
 * @return object
 */
function getPermissionsName($role)
{
    return $role->permissions()->pluck('name');
}

function flash($message, $style = 'info')
{
    session()->flash('flash.banner', $message);
    session()->flash('flash.bannerStyle', $style);
}

function addCommissionToReferals($user, $transaction){
    $realUser = $user;
    $amount = $transaction->amount;
    $level = PlanLevel::where('level', '>', 1)->orderBy('level', 'asc')->get();
    $transaction->commissionRecord()->increment('day');

    if($user && $user->ref_by && $user->plan_id && count($level) > 0 && $amount > 0 && $transaction){
        
        $user = $user->referredBy;
        
        for($i=0; $i < count($level); $i++){
            //getting direct referral of current user

            $user = User::find($user->ref_by);
            //if no referrals then breaking the loop
            if(!$user){
                break;
            }

            if(!$user->ref_by){
                continue;
            }

            // geting percentage of amout according to level
            $commission = $amount * ($level[$i]->commission / 100) / 30; 

            $user->commission += $commission;
            $user->save();


            $user->transactions()->create([
                'amount' => $commission,
                'trx' => getTrx(),
                'trx_type' => '+',
                'details' => "Referral Commission of level " . $level[$i]->level,
                'remarks' => "Referral Commission",
                'ref_id' => $realUser->id
            ]);
        }
    }
}

?>