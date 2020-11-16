# PHP SDK for HTTP Firebase Cloud Messaging Protocol
## Usage example
```php
<?php

require 'vendor/autoload.php';

$server_key = 'AAA123456...';
$device_token = 'AAABBBCCC123123...';

$client = new GuzzleHttp\Client();
$api = new Kuvardin\FirebaseHttpApiFcm\Api($client, $server_key);
$target = Kuvardin\FirebaseHttpApiFcm\Target::createWithToken($device_token);

$notification = new Kuvardin\FirebaseHttpApiFcm\Notification(
    'Amazing notification', // title
    'This is my app notification', // body 
    'FLUTTER_NOTIFICATION_CLICK' // click action
);

$response = $api->sendNotification($target, $notification, [
    'key' => 'value', // custom data for app
]);

print_r($response);
```
