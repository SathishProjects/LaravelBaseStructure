<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsOrderIdNotificationListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table ( 'notification_lists', function (Blueprint $table) {
    		$table->string ( 'order_format_id',255 )->default (0)->after('is_read'); 
    		$table->string ( 'shipment_id',255 )->default (0)->after('order_format_id');
    		$table->string ( 'status',255 )->nullable()->after('shipment_id');
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
    		$table->dropColumn ( 'order_format_id' );
    		$table->dropColumn ( 'shipment_id' );
    		$table->dropColumn ( 'status' );
    	} );
    }
}
