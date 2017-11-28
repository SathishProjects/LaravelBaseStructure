<?php
/**
 * LocalizationSettings Table
 *
 * @name       LocalizationSettings Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'localization_settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments ( 'id' );
            $table->string ( 'language' );
            $table->string ( 'time_zone' );
            $table->string ( 'currency' );
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
        Schema::drop('localization_settings');
    }
}
