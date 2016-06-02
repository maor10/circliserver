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

		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', "circlicircli");

		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', 
		    $err, 
		    $errstr, 
		    60, 
		    STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, 
		    $ctx);

		//if (!$fp)
		//exit("Failed to connect amarnew: $err $errstr" . PHP_EOL);

		//echo 'Connected to APNS' . PHP_EOL;

		// Create the payload body
		$body['aps'] = array(
		    'badge' => +1,
		    'alert' => $message,
		    'sound' => 'default'
		);

		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		if (!$result)
		    echo 'Message not delivered' . PHP_EOL;
		else
		    echo 'Message successfully delivered amar'.$message. PHP_EOL;

		// Close the connection to the server
		fclose($fp);

    }
}