<?php
  $from = $_REQUEST['from'];
  $to = $_REQUEST['to'];
  $comment = $_REQUEST['comment'];
  $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
    [
      'api_key' =>  '7272d9d0',
      'api_secret' => '60a72714de227430',
      'to' => $to,
      'from' => $from,
      'text' => $comment
    ]
  );
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  $decoded_response = json_decode($response, true);

  error_log('You sent ' . $decoded_response['message-count'] . ' messages.');
  foreach ( $decoded_response['messages'] as $message ) {
    if ($message['status'] == 0) {
      echo "Successfully Sent !";
      error_log("Success " . $message['message-id']);
    } else {
      echo "Failed !!!";
      error_log("Error {$message['status']} {$message['error-text']}");
    }
  }
?>
