<?php

namespace Database\Seeders;

use App\Models\Referral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $referrals = [
            [
                'referrals'            =>   50,
                'percent'              =>   3,
                'amount_returns'       =>   14,
                'commission_type'      =>   'plan_subscribe_commission',
                'investing_amount'     =>   2500,
                'status'               =>   0,

            ],

        ];

        foreach ($referrals as $referral) {
            Referral::create($referral);
        }
    }
}
