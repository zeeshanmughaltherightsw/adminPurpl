<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'user_id'         =>   1,
                'amount'          =>   20,
                'charge'          =>   10,
                'post_balance'    =>   5,
                'trx_type'        =>   'trx test',
                'trx'            =>   'Lorem Ipsum',    
                'details'           =>   'Lorem Ipsum',
                'remark'          =>   'Lorem Lorem Ipsum sd adfdsax',

            ],

            [
                'user_id'         =>   1,
                'amount'          =>   20,
                'charge'          =>   10,
                'post_balance'    =>   5,
                'trx_type'        =>   'trx test',
                'trx'            =>   'Lorem Ipsum',    
                'details'           =>   'Lorem Ipsum',
                'remark'          =>   'Lorem Lorem Ipsum sd adfdsax',

            ],

        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
