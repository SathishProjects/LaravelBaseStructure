<?php
/**
 * PushNotification
 *
 * @name      Moverbee
 * @version   1.0
 * @author    Contus Team <developers@contus.in>
 * @copyright Copyright (C) 2016 Contus. All rights reserved.
 * @license   GNU General Public License http://www.gnu.org/copyleft/gpl.html
 **/
namespace Apptha\Traits;

use Illuminate\Config\Repository;
use Contus\Base\Exceptions\InvalidRequestException;

trait PushNotification{
	/**
	 * Class property to hold the FCM Device Token Index
	 *
	 * @var string
	 */
	protected $fcmDeviceTokenIndex = 'android_device_key';
	/**
	 * Class property to hold the IOS Device Token Index
	 *
	 * @var string
	 */
	protected $iosDeviceTokenIndex = 'ios_device_key';
	/**
	 * Class property to hold the app the push notification targeted
	 *
	 * @var string
	 */
	protected $targetApp = false;
	/**
	 * Class property to hold the allowed targeted apps
	 *
	 * @var string
	 */
	protected $allowedTargetApps = [];
	/**
	 * Validate data and push notification to appropriate service
	 * base data exisitance
	 *
	 * @param array $data
	 * @param array $notificationData
	 * @param boolean $isSilentPush
	 * @return void
	 */
	public function push(array $data,array $notificationData,$isSilentPush = 0) {
		if(!isset($notificationData['message'])){
			return;
		}

		if(
				array_key_exists($this->fcmDeviceTokenIndex, $data)
				&& !is_null($data[$this->fcmDeviceTokenIndex])
				){
					$this->pushToFCM($data[$this->fcmDeviceTokenIndex],$notificationData,$isSilentPush);
		} elseif(
				array_key_exists($this->iosDeviceTokenIndex, $data)
				&& !is_null($data[$this->iosDeviceTokenIndex])
				){
					$this->pushToIOS($data[$this->iosDeviceTokenIndex],$notificationData,$isSilentPush);
		}
	}
	/**
	 * Get FCM token for push notification
	 * based on the targeted app
	 *
	 * @param string $platform
	 * @return string
	 * @throws \Contus\Base\Exceptions\InvalidRequestException
	 */
	public function getConfig($platform) {
		$token  = false;
		$config = app('config');

		if(empty($this->allowedTargetApps)){
			$this->setAllowedTargetApps($config);
		}

		if(
				$this->targetApp
				&& in_array($this->targetApp,$this->allowedTargetApps)
				&& $config->has("pushNotification.{$platform}.{$this->targetApp}")
				){
					$token = $config->get("pushNotification.{$platform}.{$this->targetApp}");
				}

				if(!$token){
					throw new InvalidRequestException(
							trans('messages.platform_configuration_not_exists',['platform' => $platform])
							);
				}

				return $token;
	}
	 
	/**
	 * Set the target App class property
	 *
	 * @param string $targetApp
	 * @return this
	 */
	public function setTargetApp($targetApp) {
		$this->targetApp = $targetApp;

		return $this;
	}
	/**
	 * Set the allowed target App
	 *
	 * @param \Illuminate\Config\Repository $config
	 * @return void
	 */
	public function setAllowedTargetApps(Repository $config) {
		if(
				$config->has('pushNotification.allowedTargetApps')
				&& ($allowedTargetApps = $config->get('pushNotification.allowedTargetApps'))
				&& is_array($allowedTargetApps)
				){
					$this->allowedTargetApps = $allowedTargetApps;
		}
	}
	/**
	 * iOS Pem push notification
	 *
	 * @param string $deviceToken
	 * @param array $data
	 * @param boolean $isSilentPush
	 * @return mixed
	 */
	public function pushToIOS($deviceToken,array $data,$isSilentPush = 0) {
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', $this->getConfig('ios'));
		stream_context_set_option($ctx, 'ssl', 'passphrase', '');
		 
		/** Open a connection to the APNS server */
		$fp = stream_socket_client(
			env("APNS_BINARY_INTERFACE",'ssl://gateway.sandbox.push.apple.com:2195'), 
			$err,
			$errstr, 
			60, 
			STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, 
			$ctx
		);
		 
		/** Create the payload body */
		$body['aps'] = array(
			'sound' => 'default',
			'title' => 'Moverbee',
		);

		if($isSilentPush){
			$body['aps']['content-available'] = 1;
		} else {
			$body['aps']['alert'] = $data['message'];
		}

		if(is_array($data) && !empty($data)){
			$body['data'] = $data;
		}
		 
		/** Encode the payload as JSON */
		$payload = json_encode($body);

		/** Build the binary notification */
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		/** Send it to the server */
		$result = fwrite($fp, $msg, strlen($msg));
		fclose($fp);
		app('log')->info(print_r("pushToIOS",1));
		app('log')->info(print_r($result,1));

		return $result;
	}

	/**
	 * Function to perform the fcm notifications
	 *
	 * @param string $deviceToken
	 * @param array $data
	 * @param boolean $isSilentPush
	 * @return mixed
	 */
	public function pushToFCM($deviceToken,array $data,$isSilentPush = 0) {
		$googleApiKey = $this->getConfig('fcm');
		$result = [];
		$fcmUrl = env("GOOGLE_FCM_URL","https://fcm.googleapis.com/fcm/send");

		if($googleApiKey && $fcmUrl){
			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $fcmUrl );
			curl_setopt ( $ch, CURLOPT_POST, true );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, [
				$fcmUrl,
				'Content-Type: application/json',
				'Authorization: key=' . $googleApiKey
			]);
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode([
				'to' => $deviceToken,
				'priority' => "high",
				'data' => $data,
				'content_available' => ($isSilentPush == 1)
			]));

			$result = curl_exec ( $ch );

			if ($result === FALSE) {
				app('log')->error(curl_error ($ch));
			}
			curl_close ( $ch );

			app('log')->info(print_r("FCMNotification",1));
			app('log')->info(print_r($result,1));
		}

		return $result;
	}

	/**
	 * Function to send the sms notification
	 *
	 * @param integer $mobile
	 * @param string $message
	 * @return mixed
	 */
	public function sendSMSNotification($mobile, $message = NULL) {

		/**
		 * SMS Gateway URL.
		 *
		 * @var string
		 */
		$smsGatewayURL = 'https://2factor.in/API/V1/';

		/**
		 * SMS Gateway Sender ID.
		 *
		 * @var string
		 */
		$smsGatewaySenderID = 'MOVBEE';

		/**
		 * SMS Gateway API Key.
		 *
		 * @var string
		 */
		$smsGatewayAPIKey = 'e5c42aeb-c9a1-11e6-afa5-00163ef91450';

		$gatewayURL = $smsGatewayURL . $smsGatewayAPIKey . "/ADDON_SERVICES/SEND/TSMS/";

		$curl = curl_init ();

		curl_setopt_array ( $curl, array (
				CURLOPT_URL => $gatewayURL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => http_build_query ( [
						'From' => $smsGatewaySenderID,
						'To' => $mobile,
						'Msg' => $message
				] ),
				CURLOPT_SSL_VERIFYPEER => false
		) );

		$response = curl_exec ( $curl );
		$err = curl_error ( $curl );

		curl_close ( $curl );

		if ($err) {
			app('log')->error($err);
		}
		app('log')->info(print_r("sendSMSNotification",1));
		app('log')->info(print_r($response,1));
		return $response;
	}
}