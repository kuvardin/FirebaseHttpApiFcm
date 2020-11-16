<?php

declare(strict_types=1);

namespace Kuvardin\FirebaseHttpApiFcm;

/**
 * Class Notification
 *
 * @package Kuvardin\FirebaseHttpApiFcm
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Notification
{
    /**
     * @var string|null <b>All platforms:</b> The notification's title. This field is not visible
     * on iOS phones and tablets.
     */
    public ?string $title = null;

    /**
     * @var string|null <b>All platforms:</b> The notification's body text.
     */
    public ?string $body = null;

    /**
     * @var string|null
     * <b>Android:</b> The action associated with a user click on the notification.
     * If specified, an activity with a matching intent filter is launched when a user clicks on the notification.<br>
     * <b>iOS:</b> The action associated with a user click on the notification. Corresponds to category in the APNs
     * payload.<br>
     * <b>Web:</b> The action associated with a user click on the notification. For all URL values, HTTPS is required.
     */
    public ?string $click_action = null;

    /**
     * @var string|null <b>Android:</b> The notification's channel id (new in Android O).
     * The app must create a channel with this channel ID before any notification with this channel ID is received.
     * If you don't send this channel ID in the request, or if the channel ID provided has not yet been created
     * by the app, FCM uses the channel ID specified in the app manifest.
     */
    public ?string $android_channel_id = null;

    /**
     * @var string|null <b>iOS:</b> The value of the badge on the home screen app icon.
     * If not specified, the badge is not changed. If set to 0, the badge is removed.
     */
    public ?string $badge = null;

    /**
     * @var string[]|null
     * <b>Android:</b> Variable string values to be used in place of the format specifiers in body_loc_key to use to
     * localize the body text to the user's current localization. See Formatting and Styling for more information.<br>
     * <b>iOS:</b> Variable string values to be used in place of the format specifiers in body_loc_key to use to
     * localize the body text to the user's current localization. Corresponds to loc-args in the APNs payload.
     * See Payload Key Reference and Localizing the Content of Your Remote Notifications for more information.
     */
    public ?array $body_loc_args = null;

    /**
     * @var string|null
     * <b>Android:</b> The key to the body string in the app's string resources to use to localize the body text
     * to the user's current localization. See String Resources for more information.<br>
     * <b>iOS:</b> The key to the body string in the app's string resources to use to localize the body text
     * to the user's current localization. Corresponds to loc-key in the APNs payload.
     * See Payload Key Reference and Localizing the Content of Your Remote Notifications for more information.<br>
     */
    public ?string $body_loc_key = null;

    /**
     * @var string|null <b>Android:</b> The notification's icon color, expressed in #rrggbb format.
     */
    public ?string $color = null;

    /**
     * @var string|null <b>Android:</b> The notification's icon. Sets the notification icon to myicon for drawable
     * resource myicon. If you don't send this key in the request, FCM displays the launcher icon specified
     * in your app manifest.
     */
    public ?string $icon = null;

    /**
     * @var string[]|string|null
     * <b>Android:</b> Optional, string. The sound to play when the device receives the notification. Supports "default"
     * or the filename of a sound resource bundled in the app. Sound files must reside in /res/raw/.<br>
     * <b>iOS:</b> Optional, string or Dictionary. The sound to play when the device receives the notification.
     * String specifying sound files in the main bundle of the client app or in the Library/Sounds folder
     * of the app's data container. See the iOS Developer Library for more information.
     */
    public $sound;

    /**
     * @var string|null <b>iOS:</b> The notification's subtitle.
     */
    public ?string $subtitle = null;

    /**
     * @var string|null <b>Android:</b> Identifier used to replace existing notifications in the notification drawer.
     * If not specified, each request creates a new notification. If specified and a notification with the same tag
     * is already being shown, the new notification replaces the existing one in the notification drawer.
     */
    public ?string $tag = null;

    /**
     * @var string[]|null
     * <b>Android:</b> Variable string values to be used in place of the format specifiers in title_loc_key to use to
     * localize the title text to the user's current localization. See Formatting and Styling for more information.<br>
     * <b>iOS:</b> Variable string values to be used in place of the format specifiers in title_loc_key to use
     * to localize the title text to the user's current localization. Corresponds to title-loc-args in the APNs payload.
     * See Payload Key Reference and Localizing the Content of Your Remote Notifications for more information.
     */
    public ?array $title_loc_args = null;

    /**
     * @var string|null
     * <b>Android:</b> The key to the title string in the app's string resources to use to localize the title text
     * to the user's current localization. See String Resources for more information.<br>
     * <b>iOS:</b> The key to the title string in the app's string resources to use to localize the title text
     * to the user's current localization. Corresponds to title-loc-key in the APNs payload. See Payload Key Reference
     * and Localizing the Content of Your Remote Notifications for more information.
     */
    public ?string $title_loc_key = null;

    /**
     * Notification constructor.
     *
     * @param string|null $title
     * @param string|null $body
     * @param string|null $click_action
     */
    public function __construct(?string $title, ?string $body, ?string $click_action)
    {
        $this->title = $title;
        $this->body = $body;
        $this->click_action = $click_action;
    }
}
