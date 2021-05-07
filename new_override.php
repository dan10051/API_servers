<?php
// PHP Error reporting settings
ini_set('display_errors', 0);
error_reporting(0);


// DataBase connection settings
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

define('DB_V2_HOST', '');
define('DB_V2_NAME', '');
define('DB_V2_USER', '');
define('DB_V2_PASS', '');
define('DB_V2_LOGDB', '');

define('LOGDB_ENABLED', false);
define('LOGDB_HOST', "");
define('LOGDB_NAME', '');
define('LOGDB_USER', '');
define('LOGDB_PASS', '');

if($_SERVER['DOCUMENT_ROOT'])
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);

// PayPal settings
define('PAYPAL_LIVE_USERNAME', '');
define('PAYPAL_LIVE_PASSWORD', '');
define('PAYPAL_LIVE_SIGNATURE', '');
define("PAYPAL_SANDBOX_MODE", true);


// CDN settings
define("KC_CDN_FTP_SERVER", "");
define("KC_CDN_FTP_USERNAME", "");
define("KC_CDN_FTP_PASSWORD", "");
define("KC_CDN_FTP_FILEPATH", "");
define("KC_CDN_FTP_PASSIVE_MODE", true);

define("KC_PROTECTED_CDN_FTP_SERVER", "");
define("KC_PROTECTED_CDN_FTP_USERNAME", "");
define("KC_PROTECTED_CDN_FTP_PASSWORD", "");
define("KC_PROTECTED_CDN_FTP_FILEPATH", "");
define("PROTECTED_API_ID", "158831");


define("KC_PUBLIC_CDN", [
    [
      "use_local_path"  => false,
      "local_path"      => null,
      "use_aws_s3"      => true,
      "s3_key"          => "",
      "s3_secret_key"   => "",
      "s3_region"       => "",
      "s3_bucket"       => "",
      "s3_base_url"     => ""
    ]
]);


define("KC_PROTECTED_CDN", [
    [
      "use_local_path"  => false,
      "local_path"      => null,
      "use_aws_s3"      => true,
      "s3_key"          => "",
      "s3_secret_key"   => "",
      "s3_region"       => "",
      "s3_bucket"       => "",
      "s3_base_url"     => ""
    ]
]);

define("KC_CDN_PROTOCOL", "https");
define("KC_CDN_HOST", "");
define("CACHEFLY_STATIC_APIKEY", "");


// video streaming settings
// used by resource which generating protected video url
define("CACHEFLY_PROTECT_SECRET", "");
define("PROTECT_LINK_DEFAULT_TTL", 10000);
define("KC_VIDEO_CDN_PROTOCOL", "https");
define("KC_VIDEO_CDN_HOST", "");

define("CDN77_PROTECT_SECRET", "");
define("CDN77_API_ID", "");
define("CDN77_API_USER", "");
define("CDN77_API_PASSWORD", "");

// RevAPI settings
define('REV_API_CLIENT_KEY', '');
define('REV_API_USER_KEY', '');


// SendGrid settings
define('SENDGRID_API_KEY', '');
define('EMAIL_LIVE_MODE', true); // if this is true then class v2/email will actually send messages. If this is false it will just store


// Other settings
define("DB_CACHE_ENABLE", false);
define("PROTOCOL", "https");

define("DEBUG_EXCEPTION", true);

if($_GET['debug']){
  define("DEBUGMODE", true);
}
if($_GET['monitoringToken'] == ''){
  define("MONITORING", true);
}

define("SOLR_CORE", '');
define("SOLR_HOST", '');
define("SOLR_PORT", '');
define("SOLR_USER", '');
define("SOLR_PWD", '');


//define("PROTOCOL", "https");
define("HTTP_HOST", '');
define("SERVERID", "");
define("PORTAL_BASE_DOMAIN", "");

define("PHP_EXEC", "php");

define('SESSION_TTL', '5400'); //time in seconds

define("ERROR_REPORT_EMAIL_RECEPIENT", "");

define("NOTIFICATIONS_HOOK_URL", [
    'api-notifications' => "",
    'sql-errors' => "",
    'runtime-errors' => ""
    ]);


// Lines added for #stargate-3603-api-resourses-validation-mode
define('REQUEST_VALIDATION', 2);
/**
 * Validation of server response according specification:
 * 1. 0 - no validation
 * 2. 1 - validate but not throw Error, only log
 * 3. 2 - validate and throw Error
 */
define('RESPONSE_VALIDATION', 1);






define("BBB", [
    'server-ca01' => [
      'SECURITY_SALT' => "",
      'SERVER_BASE_URL' => "",
      "BBB_PRESENTATION_BASE_URL" => ""
    ]
]);



define("REMOTE_BACKGROUND_API_HOST", "");
define("REMOTE_STATIC_IP_API_HOST", "");
define("KCAPI_AUTH_TOKEN", "");

// encrypted content license server
define("CONTENT_LICENSE_SERVER_URLS", [
    ""
]);
//define("VIDEO_ENCRYPTION_ENABLED", true);


define('DEBUG_MODE', true);
