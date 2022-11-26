<?php

use App\Models\User;
use App\Models\PlanLevel;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;


function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

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

            if(!$user->plan_id){
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

function imagePath()
{
    $data['gateway'] = [
        'path' => 'images/gateway',
        'size' => '800x800',
    ];
    $data['image'] = [
        'default' => 'images/default.png',
    ];
    $data['verify'] = [
        'withdraw'=>[
            'path'=>'images/verify/withdraw'
        ],
        'deposit'=>[
            'path'=>'images/verify/deposit'
        ]
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'images/support',
    ];
    $data['language'] = [
        'path' => 'images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['plugin'] = [
        'path' => 'images/plugin',
    ];
    $data['seo'] = [
        'path' => 'images/seo',
        'size' => '600x315'
    ];
    $data['blogimage'] = [
        'path' => 'images/frontend/blog',
        'size' => '600x315'
    ];
    return $data;
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $location = 'storage/' . $location;
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');
    if (!empty($old)) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }


    // $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $filename = uniqid() . time() . '.png';


    $image = Image::make($file);


    if (!empty($size)) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }
    return $filename;
}

?>