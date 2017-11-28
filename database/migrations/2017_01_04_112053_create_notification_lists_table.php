<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationListsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_lists', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('from_user_id');
			$table->bigInteger('to_user_id');
			$table->string('user_type');
			$table->string('service_type');
			$table->text('message');
			$table->tinyInteger('is_read');
			$table->bigInteger('order_id');
			$table->bigInteger ( 'creator_id' );
			$table->bigInteger ( 'updator_id' );
			$table->timestamps();
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('notification_lists');
	}
	}
	