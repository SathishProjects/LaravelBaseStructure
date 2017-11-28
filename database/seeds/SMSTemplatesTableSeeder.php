<?php

use Illuminate\Database\Seeder;
use Apptha\Models\SmsTemplate;

class SMSTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table ('sms_templates' )->delete ();
        DB::unprepared ( "ALTER TABLE sms_templates AUTO_INCREMENT = 1;" );
        
        $smsTemplate = [
        		'1' => [
        				'name' => 'Registration',
        				'slug' => 'customer-register',
        				'subject' => 'MoverBee - Registration Activation',
        				'content' => 'You have succesfully registered, {{EMAIL}} {{PASSWORD}} click on the activation link below.{URL}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'2' => [
        				'name' => 'Password Reset',
        				'slug' => 'password-reset',
        				'subject' => 'MoverBee - Password Reset',
        				'content' => 'Click on the link below to reset you password, {URL}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'3' => [
        				'name' => 'Order Creation',
        				'slug' => 'order-create',
        				'subject' => 'MoverBee - Order Creation',
        				'content' => 'New Order {{ORDERID}} has been created at MoverBee.com on {{TIME}} for an amount of Rs{{RS}}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        
        		'4' => [
        				'name' => 'Order Assigned',
        				'slug' => 'order-assigned',
        				'subject' => 'MoverBee - Order Assigned',
        				'content' => 'Your ORDER {{ORDERID}} will be picked up by {{DELIVERYPERSONNAME}} on {{DATE}} between {{TIMESLOT}}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'5' => [
        				'name' => 'Order Picked',
        				'slug' => 'order-pickup',
        				'subject' => 'MoverBee - Order Picked ',
        				'content' => 'Your order {{ORDERID}} has been picked by {{DRIVERYPERSONNAME}} at {{TIME}}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],        		
        		'6' => [
        				'name' => 'Order Warehouse',
        				'slug' => 'order-warehouse',
        				'subject' => 'MoverBee - Order Warehouse ',
        				'content' => 'Your order {{ORDERID}} has been picked by {{DRIVERYPERSONNAME}} at {{TIME}}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'7' => [
        				'name' => 'Order Delivered',
        				'slug' => 'order-delivered',
        				'subject' => 'MoverBee - Order Warehouse ',
        				'content' => 'Your order {{ORDERID}} has been picked by {{DRIVERYPERSONNAME}} at {{TIME}}',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'8' => [
        				'name' => 'Customer OTP',
        				'slug' => 'customer-otp',
        				'subject' => 'MoverBee - OTP',
        				'content' => 'OTP  is  {{OTP_CODE}} do not share OTP for security resasons</p>',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'9' => [
        				'name' => 'Driver Forgot Password',
        				'slug' => 'driver-forgot-password',
        				'subject' => 'MoverBee - Driver Forgot Password',
        				'content' => 'Email {{EMAIL}} Password {{PASSWORD}} do not share OTP for security resasons</p>',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		],
        		'10' => [
        				'name' => 'Driver Register',
        				'slug' => 'driver-register',
        				'subject' => 'MoverBee - Driver Register',
        				'content' => 'Email {{EMAIL}} Password {{PASSWORD}} do not share OTP for security resasons</p>',
        				'is_active' => 1,
        				'creator_id' => 1,
        				'updator_id' => 1
        		]       		
        ];
        
        foreach ( $smsTemplate as $key => $value ) {
          SmsTemplate::create ( [
          'id' => $key,
          'name' => $value ['name'],
          'slug' => $value ['slug'],
          'subject' => $value ['subject'],
          'content' => $value ['content'],
          'is_active' => $value ['is_active'],
          'creator_id' => $value ['creator_id'],
          'updator_id' => $value ['updator_id'],
          ] );
        }
    }
}
