<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->truncate();
        
        GeneralSetting::insert(
            [
                // Site info settings
                ['group' => 'site_info', 'options' => '[]', 'type' => 'text', 'name' => 'Site name', 'key' => 'site_name', 'value' => 'AAM Earning', 'is_required' => 1, 'created_at' => Carbon::now()],
                ['group' => 'site_info', 'options' => '[]', 'type' => 'text', 'name' => 'Site phone', 'key' => 'site_phone', 'value' => '+923001309060', 'is_required' => 1, 'created_at' => Carbon::now()],
                ['group' => 'site_info', 'options' => '[]', 'type' => 'email', 'name' => 'Site email', 'key' => 'site_email', 'value' => 'Contact@aamclick.com', 'is_required' => 1, 'created_at' => Carbon::now()],
                // ['group' => 'site_info', 'options' => '[]', 'type' => 'text', 'name' => 'System info', 'key' => 'system_info', 'value' => '[]', 'is_required' => null, 'created_at' => Carbon::now()],
                ['group' => 'site_info', 'options' => '[]', 'type' => 'file', 'name' => 'Logo', 'key' => 'logo', 'value' => '/logo.png', 'is_required' => null, 'created_at' => Carbon::now()],
                ['group' => 'site_info', 'options' => '[]', 'type' => 'file', 'name' => 'Favicon', 'key' => 'favicon', 'value' => '/favicon.ico', 'is_required' => null, 'created_at' => Carbon::now()],

                ['group' => 'currency_setting', 'options' => '[]', 'type' => 'text', 'key' => 'cur_text', 'name' => 'Currency Text', 'value' => 'USDT', 'is_required' => null, 'created_at' => Carbon::now()],
                ['group' => 'currency_setting', 'options' => '[]', 'type' => 'text', 'name' => 'Currency symbol', 'key' => 'cur_sym', 'value' => '$', 'is_required' => null, 'created_at' => Carbon::now() ],
                //Referrals
                ['group' => 'referrals', 'type' => 'select', 'name' => 'Can Create Referral', 'key' => 'referrals',  'value' => 'everyone', 'options' => '["no_one","everyone","on_plan"]', 'is_required' => null, 'created_at' => Carbon::now()],
                
                [
                    'group' => 'maintainance_mode',
                    'options' => '[]',
                    'type' => 'checkbox',
                    'name' => 'Maintanance mode',
                    'key' => 'maintainance_mode',
                    'value' => '0',
                    'is_required' => null,
                    'created_at' => Carbon::now()
                ],
                [
                    'group' => 'payment',
                    'options' => '[]',
                    'type' => 'text',
                    'name' => 'Payment Address',
                    'key' => 'payment_address',
                    'value' => '0xCcC1A649Ec08aFfAC28A516B4a7F84f61EEc62C0', // provided by clinets
                    'is_required' => 1,
                    'created_at' => Carbon::now()
                ],
                [
                    'group' => 'payment',
                    'options' => '[]',
                    'type' => 'text',
                    'name' => 'Minimum ammount',
                    'key' => 'min_amount',
                    'value' => '20',
                    'is_required' => 1,
                    'created_at' => Carbon::now()
                ],
                [
                    'group' => 'payment',
                    'options' => '[]',
                    'type' => 'checkbox',
                    'name' => 'Use Test Account',
                    'key' => 'test_account',
                    'value' => '0',
                    'is_required' => 0,
                    'created_at' => Carbon::now()
                ],
                [
                    'group' => 'transfer',
                    'options' => '[]',
                    'type' => 'text',
                    'name' => 'Minimum ammount',
                    'key' => 'min_amount',
                    'value' => '20',
                    'is_required' => 1,
                    'created_at' => Carbon::now()
                ],
                [
                    'group' => 'transfer',
                    'options' => '[]',
                    'type' => 'text',
                    'name' => 'Fee',
                    'key' => 'fee',
                    'value' => '5',
                    'is_required' => 1,
                    'created_at' => Carbon::now()
                ],
                [
                    'group' => 'transfer',
                    'options' => '[]',
                    'type' => 'checkbox',
                    'name' => 'Tranferable',
                    'key' => 'transferable',
                    'value' => '1',
                    'is_required' => 0,
                    'created_at' => Carbon::now()
                ]
            ]
        );

        // email settings and Push Notifications
        // $groups = [
        //     'email_notification',
        //     'push_notification',
        //     'payment'
        // ];
        // $types = [
        //     'General',
        // ];

        // $generalForEmail = [
        //         [
        //             'key' => 'email_from_name',
        //             'name' => 'Email From Name',
        //             'value' => 'Aamearning',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'reply_to_name',
        //             'name' => 'Reply to Name',
        //             'value' => 'Aamearning',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'reply_to_email',
        //             'name' => 'Reply to Email',
        //             'value' => 'admin@aamearning.com',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'mail_mailer',
        //             'name' => 'Mail Mailer',
        //             'value' => 'smtp',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'mail_host',
        //             'name' => 'Mail Host',
        //             'value' => 'smtp.mailtrap.io',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'mail_port',
        //             'name' => 'Mail Port',
        //             'value' => '2525',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'mail_username',
        //             'name' => 'Mail Username',
        //             'value' => '',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'mail_password',
        //             'name' => 'Mail Password',
        //             'value' => '',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'key' => 'encryption_type',
        //             'name' => 'Encryption Type',
        //             'value' => 'tls',
        //             'is_required' => null,
        //             'created_at' => Carbon::now()
        //         ],
        //     ];
            
        //         foreach($groups as $group){   
        //             foreach($types as $type){
        //                 if($type == 'General'){
        //                     // general data stored
        //                     if($group == 'email_notification'){
        //                         foreach ($generalForEmail as $setting) {
        //                             $setting = array_merge($setting,['type' => $type, 'group' => $group]);
        //                             GeneralSetting::create($setting);
        //                         } 
        //                     }
        //                 }
        //             }
        //         }
    }
}
