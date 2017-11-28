<?php
/**
 * AdminUserGroups Table
 *
 * @name       AdminUserGroups Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAdminUserGroupsTable extends Migration {
/**
 * Run the migrations.
 *
 * @return void
 */
public function up() {
    Schema::create ( 'admin_user_groups', function (Blueprint $table) {
    $table->engine = 'InnoDB';
    $table->bigIncrements ( 'id' );
    $table->bigInteger ( 'user_id' );
    $table->integer ( 'group_id' );
    $table->timestamps ();
    } );
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down() {
       Schema::drop('admin_user_groups');
    }
}
