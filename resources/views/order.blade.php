<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once '/path/to/vendor/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "AC5493c31b3373d86f3a549742ad356041";
    $token  = "214ce9dd4762dbf7e141103c469833ac";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("whatsapp:+573187200092", // to
        array(
          "from" => "whatsapp:+14155238886",
          "body" => "Cambio de mensaje"
        )
      );

print($message->sid);
