<?php
/**
 * SettingCategories Table
 *
 * @name       SettingCategories Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'setting_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments ( 'id' );
            $table->string ( 'parent_id' );
            $table->string ( 'name' );
            $table->string ( 'slug' );
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
        Schema::drop('setting_categories');
    }
}
