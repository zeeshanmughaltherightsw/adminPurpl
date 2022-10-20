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
                'referrals'            =>   10,
                'percent'              =>   1,
                'amount_returns'       =>   14,
                'commission_type'      =>   'plan_subscribe_commission',
                'status'               =>   0,

            ],

        ];

        foreach ($referrals as $referral) {
            Referral::create($referral);
        }
    }
}
