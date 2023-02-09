<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', static function (Blueprint $table) {
            $table->json('notification_emails')->nullable()->default(new Expression('(JSON_ARRAY())'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', static function (Blueprint $table) {
            $table->dropColumn('notification_emails');
        });
    }
};
