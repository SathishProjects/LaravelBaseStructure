<?php
/**
 * States Table
 *
 * @name       States Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'states', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments ( 'id' );
            $table->unsignedInteger( 'country_id' );
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string ( 'name' );
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
        Schema::drop('states');
    }
}
