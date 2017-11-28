<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsNotificationListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    	
    	Schema::table ( 'notification_lists', function (Blueprint $table) {
    		$table->dropColumn ( 'order_id' );
        } );    	
    	Schema::table ( 'notification_lists', function (Blueprint $table) {    		
    		$table->string ( 'order_id',255 )->default (0)->after('is_read');    		
    		$table->string ( 'from_user_name' )->nullable()->after( 'from_user_id' );
    		$table->string ( 'to_user_name' )->nullable()->after( 'from_user_name' );
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
    		$table->dropColumn ( 'order_id' );
    		$table->dropColumn ( 'from_user_name' );
    		$table->dropColumn ( 'to_user_name' );
    	} );
    }
}
