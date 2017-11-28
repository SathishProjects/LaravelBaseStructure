<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldJobTypeNotificationListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table ( 'notification_lists', function (Blueprint $table) {
    		$table->string ( 'job_type',255 )->nullable()->after('status');    		
    	} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table ( 'notification_lists', function (Blueprint $table) {
    		$table->dropColumn ( 'job_type' );    		
    	} );
    }
}
