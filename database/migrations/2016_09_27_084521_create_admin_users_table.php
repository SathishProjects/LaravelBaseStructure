<?php
/**
 * AdminUsers Table
 *
 * @name       AdminUsers Table
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'admin_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements ( 'id' );
            $table->unsignedInteger ( 'user_role_id' );
            $table->string ( 'name' );
            $table->string ( 'email' );
            $table->string ( 'password' )->nullable();
            $table->string ( 'mobile_number',20 );
            $table->enum('gender', ['male', 'female']);
            $table->string ( 'profile_image' )->nullable();
            $table->string ( 'verification_code',100 )->nullable();
            $table->tinyInteger ('is_verified')->nullable();
            $table->string ( 'access_token' )->nullable();
            $table->tinyInteger ( 'is_active' )->default ( 0 );
            $table->Integer ( 'city_id' )->nullable ();
            $table->Integer ( 'state_id' )->nullable ();
            $table->Integer ( 'country_id' )->nullable ();
            $table->String( 'address' )->nullable ();
            $table->Integer( 'zipcode' )->nullable ();
            $table->String( 'company' , 225)->nullable ();
            $table->rememberToken ();
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
      Schema::drop('admin_users');
    }
}
