<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_no',
        'ref_by',
        'investment'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted(){
        parent::boot();

        static::retrieved(function(User $user){
            $plan = $user->plan; 
            if($plan){
                $totalEarning = $user->profit + $user->commission + $user->reward;
                if($totalEarning >= $user->plan_expiry * $user->investment){
                    $user->plan_id = null;
                    $user->save();
                }
            }
        });

        static::creating(function (User $user) {
            $user->nonce = mt_rand(1,1000000) * 1000000;
        });
        static::created(function (User $user) {
            $user->assignRole($user->user_type);
        });
    }

    public function statusChanger()
    {
        $this->status = $this->status == 'active' ? 'inactive' : 'active';
        return $this;
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'ref_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'ref_by');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
