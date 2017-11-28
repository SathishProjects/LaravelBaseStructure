<?php
/**
 * Cities Table
 *
 * @name       Cities Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create ( 'cities', function (Blueprint $table) {
    $table->engine = 'InnoDB';
    $table->bigIncrements ( 'id' );
    $table->string ( 'name' );
    $table->tinyInteger ( 'is_active' );
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
     Schema::drop('cities');
    }
}
