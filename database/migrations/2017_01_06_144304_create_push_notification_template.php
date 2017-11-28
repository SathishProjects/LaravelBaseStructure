<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushNotificationTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create ( 'push_notification', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments ( 'id' );
      $table->string ( 'name' );
      $table->string ( 'slug' );
      $table->string ( 'subject' );
      $table->text ( 'body' );
      $table->tinyInteger ( 'is_active' )->default ( 1 );
      $table->bigInteger ( 'creator_id' );
      $table->bigInteger ( 'updator_id' );
      $table->timestamps ();
     } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     Schema::drop ( 'push_notification' );
    }
}
