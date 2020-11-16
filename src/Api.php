<?php

declare(strict_types=1);

namespace Kuvardin\FirebaseHttpApiFcm;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Api
 *
 * @package Kuvardin\FirebaseHttpApiFcm
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Api
{
    public const CONNECT_TIMEOUT_DEFAULT = 7;
    public const REQUEST_TIMEOUT_DEFAULT = 10;

    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';

    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var string
     */
    protected string $server_key;

    /**
     * @var ResponseInterface|null
     */
    public ?ResponseInterface $last_response = null;

    /**
     * @var int
     */
    public int $connect_timeout = self::CONNECT_TIMEOUT_DEFAULT;

    /**
     * @var int
     */
    public int $request_timeout = self::REQUEST_TIMEOUT_DEFAULT;

    /**
     * Api constructor.
     *
     * @param Client $client
     * @param string $server_key
     */
    public function __construct(Client $client, string $server_key)
    {
        $this->client = $client;
        $this->server_key = $server_key;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getServerKey(): string
    {
        return $this->server_key;
    }

    /**
     * @param Target $target
     * @param Notification $notification
     * @param array|null $data This parameter specifies the custom key-value pairs of the message's payload.
     * @param string|null $collapse_key This parameter identifies a group of messages (e.g., with collapse_key:
     * "Updates Available") that can be collapsed, so that only the last message gets sent when delivery can be resumed.
     * This is intended to avoid sending too many of the same messages when the device comes back online
     * or becomes active.<br>
     * Note that there is no guarantee of the order in which messages get sent.<br>
     * Note: A maximum of 4 different collapse keys is allowed at any given time.
     * This means a FCM connection server can simultaneously store 4 different messages per client app.
     * If you exceed this number, there is no guarantee which 4 collapse keys the FCM connection server will keep.
     * @param string|null $priority  Sets the priority of the message. Valid values are "normal" and "high."
     * On iOS, these correspond to APNs priorities 5 and 10.<br>
     * By default, notification messages are sent with high priority, and data messages are sent with normal priority.
     * Normal priority optimizes the client app's battery consumption and should be used unless immediate delivery
     * is required. For messages with normal priority, the app may receive the message with unspecified delay.<br>
     * When a message is sent with high priority, it is sent immediately, and the app can display a notification.
     * @param bool|null $content_available On iOS, use this field to represent content-available in the APNs payload.
     * When a notification or message is sent and this is set to true, an inactive client app is awoken, and the message
     * is sent through APNs as a silent notification and not through the FCM connection server.
     * Note that silent notifications in APNs are not guaranteed to be delivered, and can depend on factors such as the
     * user turning on Low Power Mode, force quitting the app, etc. On Android, data messages wake the app by default.
     * On Chrome, currently not supported.
     * @param array|bool|null $mutable_content Currently for iOS 10+ devices only. On iOS, use this field to represent
     * mutable-content in the APNs payload. When a notification is sent and this is set to true, the content of
     * the notification can be modified before it is displayed, using a Notification Service app extension.
     * This parameter will be ignored for Android and web.
     * @param int|null $time_to_live This parameter specifies how long (in seconds) the message should be kept in FCM
     * storage if the device is offline. The maximum time to live supported is 4 weeks, and the default value is
     * 4 weeks. For more information, see Setting the lifespan of a message.
     * @param string|null $restricted_package_name This parameter specifies the package name of the application where
     * the registration tokens must match in order to receive the message.
     * @param bool|null $dry_run This parameter, when set to true, allows developers to test a request without actually
     * sending a message.<br>
     * The default value is false.
     * @return mixed
     * @throws GuzzleException
     */
    public function sendNotification(Target $target, Notification $notification, array $data = null,
        string $collapse_key = null, string $priority = null, bool $content_available = null, $mutable_content = null,
        int $time_to_live = null, string $restricted_package_name = null, bool $dry_run = null)
    {
        $response = $this->request([
            'to' => $target->getToken() ?? $target->getTopicFull(),
            'condition' => $target->getCondition(),
            'registration_ids' => $target->getRegistrationIds(),
            'notification' => $notification,
        ]);

        return $response;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     */
    public function request(array $data)
    {
        $uri = 'https://fcm.googleapis.com/fcm/send';
        $this->last_response = $this->client->post($uri, [
            RequestOptions::CONNECT_TIMEOUT => $this->connect_timeout,
            RequestOptions::TIMEOUT => $this->request_timeout,
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => "key={$this->server_key}",
            ],
            RequestOptions::JSON => $data,
        ]);

        $response_contents = $this->last_response->getBody()->getContents();
        return json_decode($response_contents, true, 512, JSON_THROW_ON_ERROR);
    }
}
