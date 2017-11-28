<?php
/**
 * Settings Table
 *
 * @name       Settings Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create ( 'settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments ( 'id' );
            $table->unsignedInteger( 'setting_category_id' )->unsigned();
            $table->foreign ( 'setting_category_id' )->references ( 'id' )->on ( 'setting_categories' );
            $table->string ( 'setting_name' );
            $table->string ( 'setting_value' );
            $table->string ( 'display_name' );
            $table->string ( 'class' )->nullable();
            $table->string ( 'type' );
            $table->string ( 'option' )->nullable();
            $table->string ( 'description' )->nullable();
            $table->bigInteger( 'order' );
            $table->tinyInteger ( 'is_active' )->default ( 1 );
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
        Schema::drop('settings');
    }
}
