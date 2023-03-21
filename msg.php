<?php
	// xjz28egP+LE-c7wNVhDpXST5kWmgzgNZLnSg6oPGI7
	$apiKey = urlencode('xjz28egP+LE-c7wNVhDpXST5kWmgzgNZLnSg6oPGI7');

	// Message details
	$numbers = array(919121141400);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode('This is your message Hello');

	$numbers = implode(',', $numbers);

	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);

	// Process your response here
	echo $response;
?>
