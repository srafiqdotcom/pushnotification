<?php


// Path to the .p8 file downloaded from apple
// see: https://developer.apple.com/documentation/usernotifications/setting_up_a_remote_notification_server/establishing_a_token-based_connection_to_apns#2943371
$authKey = "Authkey_asdf43453xs.p8";

// Team ID (From the Membership section of the ios developer website)
// see: https://developer.apple.com/account/
$teamId = '84N85B6A6Y';

// The "Key ID" that is provided when you generate a new key
$keyId = 'asdf43453xs';

// The Bundle ID of the app you want to send the notification to
$bundleId = 'com.organization.app';

// Device token (registration id)
$devToken = 'D76E689400067B22B5FC993132Z39DC9VV641CF2L880221881716DB17466933E';

// The content of the push notification
// see: https://developer.apple.com/library/archive/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/CreatingtheNotificationPayload.html#//apple_ref/doc/uid/TP40008194-CH10-SW1

#for push notification
$body = array(
    'content-available' => 1
    );

#for silent notification use following 
// $body = array(
//     'content-available' => 1,
//     'sound' => ''
//     );


$payload = array();
$payload['aps'] = $body;
$payload['api-Id'] = 4;





$notification_payload = $payload;




################################################################################
## Generate JWT ################################################################
################################################################################

function b64($raw, $json=false){
    if($json) $raw = json_encode($raw);
    return str_replace('=', '', strtr(base64_encode($raw), '+/', '-_'));
}

$token_key = file_get_contents($authKey);

$jwt_header = [
'alg' => 'ES256',
'kid' => $keyId
];

$jwt_payload = [
'iss' => $teamId,
'iat' => time()
];

$raw_token_data = b64($jwt_header, true).".".b64($jwt_payload, true);

$signature = '';

openssl_sign($raw_token_data, $signature, $token_key, 'SHA256');

$jwt = $raw_token_data.".".b64($signature);

################################################################################
## Send Message ################################################################
################################################################################

$request_body = json_encode($notification_payload);
#for production use production url
$url = "https://api.sandbox.push.apple.com/3/device/$devToken";

$ch = curl_init($url);
curl_setopt_array($ch, [
CURLOPT_POSTFIELDS => $request_body,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
CURLOPT_HTTPHEADER => [
"content-type: application/json",
"authorization: bearer $jwt",
"apns-topic: $bundleId"
]
]);
$response = curl_exec($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);

curl_close($ch);

################################################################################
## Do something with output ####################################################
################################################################################

header('Content-Type: text/plain');

echo "-----";
echo "HTTP Code: $httpcode\n";
echo "cURL Error: ".var_export($err, true)."\n";
echo "Response: \n$response\n";
