<?php
/**
 * UserRoles Table
 *
 * @name       UserRoles Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserRolesTable extends Migration {
/**
 * Run the migrations.
 *
 * @return void
 */
public function up() {
    Schema::create ( 'user_roles', function (Blueprint $table) {
    $table->engine = 'InnoDB';
    $table->increments ( 'id' );
    $table->string ( 'name',25 );
    $table->string ( 'slug', 25 )->nullable();
    $table->text( 'permissions' )->nullable();
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
public function down() {
        Schema::drop('user_roles');
    }
}
