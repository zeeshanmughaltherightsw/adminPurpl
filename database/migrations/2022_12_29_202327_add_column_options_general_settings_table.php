<?php

use Carbon\Carbon;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->json('options')->nullable()->default('[]');
        });

        GeneralSetting::insert(
            ['group' => 'referrals', 'type' => 'select', 'name' => 'Can Create Referral', 'key' => 'referrals',  'value' => 'everyone', 'options' => '["no_one","everyone","on_plan"]', 'is_required' => null, 'created_at' => Carbon::now()],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
