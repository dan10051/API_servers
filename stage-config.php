<?php
// PHP Error reporting settings
ini_set('display_errors', 0);
error_reporting(0);


$db_host = "";
$db_host_ro = "k";


define('DB_HOST', $db_host); // sql1
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

define('DB_V2_HOST', $db_host); // sql1
define('DB_V2_NAME', '');
define('DB_V2_USER', '');
define('DB_V2_PASS', '');


define('DB_V2_READONLY_HOST', $db_host_ro);

define('LOGDB_ENABLED', false);
define('LOGDB_HOST', "");
define('LOGDB_NAME', '');
define('LOGDB_USER', '');
define('LOGDB_PASS', '');

if($_SERVER['DOCUMENT_ROOT'])
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);

// PayPal settings
// real actual live keys, DON'T SHARE. If someone must test with live credintials, then use another live account
define('PAYPAL_LIVE_USERNAME', '');//..
define('PAYPAL_LIVE_PASSWORD', '');//
define('PAYPAL_LIVE_SIGNATURE', '');//
define("PAYPAL_SANDBOX_MODE", false);


 define("KC_CDN_FTP_SERVER", "..com");
 define("KC_CDN_FTP_USERNAME", "-cdn");
 define("KC_CDN_FTP_PASSWORD", "");
 define("KC_CDN_FTP_FILEPATH", "");
 define("KC_CDN_FTP_PASSIVE_MODE", true);

define("KC_PROTECTED_CDN_FTP_SERVER", "..com");
define("KC_PROTECTED_CDN_FTP_USERNAME", "-");
define("KC_PROTECTED_CDN_FTP_PASSWORD", "");
define("KC_PROTECTED_CDN_FTP_FILEPATH", "");
define("PROTECTED_API_ID", "109388");


define("KC_PROTECTED_CDN", [
    [
      "use_local_path"  => true,
      "local_path"      => "/var/www/..",
      "cdn77id"         => ""
    ],
    [
      "server"          => "..",
      "username"        => "",
      "password"        => "",
      "filepath"        => "",
      "cdn77id"         => "",
      "passive_mode"	=> true
    ]
]);


define("KC_PUBLIC_CDN", [
    [
      "server"          => "..",
      "username"        => "-",
      "password"        => "",
      "filepath"        => "",
      "cdn77id"         => "",
      "passive_mode"  => true
    ]
]);

define("KC_CDN_PROTOCOL", "https");

define("KC_CDN_HOST", "..");

define("CACHEFLY_STATIC_APIKEY", "");

// video streaming settings
// used by resource which generating protected video url
define("CACHEFLY_PROTECT_SECRET", "");
define("PROTECT_LINK_DEFAULT_TTL", 10000);
define("KC_VIDEO_CDN_PROTOCOL", "https");
define("KC_VIDEO_CDN_HOST", "..com");


define("CDN77_API_ID", "");
define("CDN77_PROTECT_SECRET", ""); // old stage secret -- 0fg6oacnhprwavvy
define("CDN77_API_USER", "@.com");
define("CDN77_API_PASSWORD", "");

// encrypted content license server
define("CONTENT_LICENSE_SERVER_URLS", [
    "https://",
]);

define("VIDEO_ENCRYPTION_ENABLED", true);

// RevAPI settings
define('REV_API_CLIENT_KEY', '');
define('REV_API_USER_KEY', '/=');


// SendGrid settings
define('SENDGRID_API_KEY', '');
define('EMAIL_LIVE_MODE', true); // if this is true then class v2/email will actually send messages. If this is false it will just store


// Other settings
define("DB_CACHE_ENABLE", false);
define("PROTOCOL", "http");

define("DEBUG_EXCEPTION", true);

define("PHP_EXEC", "php");

if($_GET['debug']){
  define("DEBUGMODE", true);
}
if($_GET['monitoringToken'] == ''){
  define("MONITORING", true);
}
define("MONITORINGTOKEN", '');

define("SOLR_CORE", 'stage');
define("SOLR_HOST", '');
define("SOLR_PORT", '8983');
define("SOLR_USER", '');
define("SOLR_PWD", '');

define("PROTOCOL", "https");
define("HTTP_HOST", '..');
define("PORTAL_BASE_DOMAIN", ".");

define('SESSION_TTL', '5400'); //time in seconds



define('SHARE_A_SALE_CONFIG', [
    'merchantID' => '',
    'APIToken' => '',
    'APISecretKey' => '',
    'APIVersion' => '2.9'
]);

define("APIID", "stage");
define("SERVERID", "API-stage");
define("CACHE_ENABLED", false);
define("CACHE_TTE", 300);
define("KCAPI_AUTH_TOKEN", "");


define("SUBSCRIBE_COUNTRIES", "US,CA,MX,RU");

define("ERROR_REPORT_EMAIL_RECEPIENT", "");

define("NOTIFICATIONS_HOOK_URL", [
    'api-notifications' => "",
    'sql-errors' => "",
    'runtime-errors' => ""
    ]);

define('ASSETS_OVERRIDE', __DIR__ . '/assets_override');

define("BBB", [
    'server-ca01' => [
      'SECURITY_SALT' => "",
      'SERVER_BASE_URL' => "",
      "BBB_PRESENTATION_BASE_URL" => ""
    ]
]);
