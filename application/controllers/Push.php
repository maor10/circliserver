<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends Base_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
        parent::__construct();

        $this->load->model("users_model");
    }

    public function create($user_id){

    	$this->load->model("users_model");

    	$res = $this->users_model->get_one($user_id)->result();

    	if (is_null($res))
    		return "Error";

    	$device = $res[0]["device_token"];
    	
		$payload['aps'] = array('alert' => 'This is the alert text', 'badge' => 1, 'sound' => 'default');
		$payload['server'] = array('serverId' => $serverId, 'name' => $name);
		$output = json_encode($payload);

		$apnsCert = 'ck.pem';

		$streamContext = stream_context_create();
		stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);

		$apns = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);

		$apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device)) . chr(0) . chr(strlen($payload)) . $payload;
		fwrite($apns, $apnsMessage);

		//socket_close($apns); seems to be wrong here ...
		fclose($apns);

    }