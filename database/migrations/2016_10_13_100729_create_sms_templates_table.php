<?php
/**
 * SMSTemplates Table
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create ( 'sms_templates', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments ( 'id' );
      $table->string ( 'name' );
      $table->string ( 'slug' );
      $table->string ( 'subject' );
      $table->text ( 'content' );
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
     Schema::drop ( 'sms_templates' );
    }
}
