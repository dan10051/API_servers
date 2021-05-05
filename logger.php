<?php


class Logger
{
    private static $_instance = null;
    var $hookedClasses = array();
    var $backgroundFunctions = array();

    private function __construct()
    {
    }

    private function __clone()
    {
    }



    private function _write($session, $method, $resource, $params, $date, $time, $code, $text, $resourceFile)
    {
        if(!API_REQUEST_GUID) return false;
//        if(!defined("LOGDB_NAME") || !LOGDB_NAME || !defined("LOGDB_ENABLED") || !LOGDB_ENABLED) return false;
        $sqls = array();

//        if($resource == 'v2/auth'){
//            if(isset($params['password'])) $params['password'] = '***';
//        }

        $api_log_guid = API_REQUEST_GUID;
        $arFields = array(
            "id" => $api_log_guid,
            "api_sessions_id" => $session ? (string)$session : NULL,
            "method" => strval($method),
            "resource" => strval($resource),
            "params" => json_encode($params),
            "date" => strval($date),
            "execution_time" => $time,
            "response_code" => strval($code),
            "response_text" => strval($text),
            "user_ip" => UserHelper::GetUserIP(),
            "SQLexecuted" => DataBase::getTotals('sqlQueries'),
            "SQLreadFromCache" => DataBase::getTotals('readFromCache'),
            "resource_file" => strval($resourceFile)
            //errorResponse

        );

        $Fields_sys_log = array(
            "id" => $api_log_guid,
            "method" => strval($method),
            "resource" => strval($resource),
            "date" => strval(str_replace("\"","",$date)),
            "response_code" => strval($code),
            "user_ip" => UserHelper::GetUserIP(),
            "SQLexecuted" => DataBase::getTotals('sqlQueries'),
            "SQLreadFromCache" => DataBase::getTotals('readFromCache'),
            "response_text" => strval(str_replace(array("\r\n","\n","\r"," "),"",$text)),
            "params" => str_replace(array("\r\n","\n","\r"," "),"",json_encode($params))
        );



        $session = $session ? (string)$session : NULL;

        $this->logs_to_scv($Fields_sys_log, "api_sys_log", $api_log_guid);

        $sqls[] = $sql = "'".strval($session)."','".strval($method)."','".strval($resource)."','".addslashes(json_encode($params))."','".strval($date)."','".$time."','".strval($code)."','".strval(addslashes($text))."', `user_ip` = '".UserHelper::GetUserIP()."', `SQLexecuted` = '".DataBase::getTotals('sqlQueries')."', `SQLreadFromCache` = '".DataBase::getTotals('readFromCache')."', `resource_file` = '".strval($resourceFile)."' WHERE `id` = '".$api_log_guid."'";

        // write SQL log
        $cache = DataBase::getTotals();
        $sqlQueries = $cache['sqlQueriesDetails'];
        // $cacheFilePath = LOG_PATH.'/resources_db_queries/'.$api_log_guid.'.json';
        if(sizeof($sqlQueries)){
            $inserBlocks = array();
            foreach ($sqlQueries as $order => $value) {

                if(!is_null($value['SQLerror']))
                    $SQLerror = "'".strval(addslashes(trim(json_encode($value['SQLerror']))))."'";
                else
                    $SQLerror = "NULL";

                $inserBlocks[] = "('".$api_log_guid."', '".$order."', '".strval(trim($value['type']))."', '".strval(addslashes(trim($value['query'])))."', '".strval(addslashes(trim($value['debug_backtrace'])))."', '".md5(strval(addslashes(trim($value['query']))))."', '".md5(strval(addslashes(trim($value['debug_backtrace']))))."', ".$SQLerror.", '".intval($value['success'])."', ".floatval($value['tte']).", ".floatval($value['timestamp']).", '".intval($value['fromCache'])."', ".($value['server'] ? "'".$value['server']."'" : "null").")";

                $Fields_sql_queries = array(
                    "api_log_id" => $api_log_guid,
                    "order" => $order,
                    "type" => strval(trim($value['type'])),
                    "query" => strval(str_replace(array("\r\n","\n","\r"," "),"",$value['query'])),
                    "debug_backtrace" => strval(str_replace(array("\r\n","\n","\r"," "),"",$value['debug_backtrace'])),
                    "query_md5" => md5(strval(addslashes(trim($value['query'])))),
                    "debug_backtrace_md5" => md5(strval(addslashes(trim($value['debug_backtrace'])))),
                    "SQLerror" => $SQLerror,
                    "success" => intval($value['success']),
                    "tte" => floatval($value['tte']),
                    "timestamp" => floatval($value['timestamp']),
                    "fromCache" => intval($value['fromCache']),
                    "server" => ($value['server']? "'".$value['server']."'" : "null")
                    //errorResponse
                );

//                $inserBlocks_t[] = "'".$api_log_guid."', '".$order."', '".strval(trim($value['type']))."', '".strval(addslashes(trim($value['query'])))."', '".strval(addslashes(trim($value['debug_backtrace'])))."', '".md5(strval(addslashes(trim($value['query']))))."', '".md5(strval(addslashes(trim($value['debug_backtrace']))))."', ".$SQLerror.", '".intval($value['success'])."', ".floatval($value['tte']).", ".floatval($value['timestamp']).", '".intval($value['fromCache'])."', ".($value['server'] ? "'".$value['server']."'" : "null").";

            }
            $sqls[] = $sql = "INSERT INTO `".LOGDB_NAME."`.`api_resources_sql_queries` (`api_log_id`, `order`, `type`, `query`, `debug_backtrace`, `query_md5`, `debug_backtrace_md5`, `SQLerror`, `success`, `tte`,`timestamp`, `fromCache`, `server`) VALUES ".implode(", ", $inserBlocks);
        }

          $this->logs_to_scv($Fields_sql_queries, "api_resources_sql_queries", $api_log_guid);

        $hookedClasses = Logger::getInstance()->hookedClasses;
        if(sizeof($hookedClasses)){
            $i = 0;
            $inserBlocks = array();
            foreach($hookedClasses as $class){
                $inserBlocks[] = "('".$api_log_guid."', '".$i."', '".strval(trim($class))."')";
                $i++;
            }
            $sqls[] = $sql = "INSERT INTO `".LOGDB_NAME."`.`api_resources_hooked_classes` (`api_log_id`, `order`, `class`) VALUES ".implode(", ", $inserBlocks);

            $Fields_hooked_classes = array(
                "api_log_id" => $api_log_guid,
                "order" => $order,
                "class" => strval(trim($class))
           );

          $this->logs_to_scv($Fields_hooked_classes, "api_resources_hooked_classes", $api_log_guid);

        }

        //
        $backgroundFunctions = Logger::getInstance()->backgroundFunctions;

        if(sizeof($backgroundFunctions)){
            $i = 0;
            $inserBlocks = array();
            foreach($backgroundFunctions as $jobId){
                $inserBlocks[] = "('".$api_log_guid."', '".$i."', '".strval(trim($jobId))."')";
                $i++;
            }
            $sqls[] = $sql = "INSERT INTO `".LOGDB_NAME."`.`api_resources_background_functions` (`api_log_id`, `order`, `jobId`) VALUES ".implode(", ", $inserBlocks);

            $Fields_backgroundFunctions = array(
                "api_log_id" => $api_log_guid,
                "order" => $order,
                "jobId" => strval(trim($jobId))
           );

          $this->logs_to_scv($Fields_backgroundFunctions, "api_resources_background_functions", $api_log_guid);
        }



        // DataBase::query($sql);
        Logger::writeApiLogFile(implode("\n----\n",$sqls));
        // $logFilePath = LOG_PATH."/api_log_queries/".API_REQUEST_GUID.".sql";
        // // echo $logFilePath;
        // file_put_contents($logFilePath, implode("\n----\n",$sqls));

        return $api_log_guid;
    }

    /**
     * the old way of writing a query to the database
     * @param $version
     */
    static function saveRequestToSysLog($version) {

        if(defined('LOGDB_NAME') && LOGDB_NAME &&
            defined('LOGDB_ENABLED') && LOGDB_ENABLED
            && $version === 'v2') {
            define('API_REQUEST_GUID', UserHelper::CreateGUID());
        } else {
            define('API_REQUEST_GUID', null);
            return;
        }

        $resource                   = strval(UrlParser::path());

        $sql                        = "INSERT INTO `".LOGDB_NAME.
            "`.`api_sys_log` (`id`,`method`,`resource`,`params`,`date`,`response_code`,`user_ip`, `cpu`, `server`, `apiid`) VALUES ('"
            .API_REQUEST_GUID."','".strval(METHOD)."','"
            .$resource."','".addslashes(json_encode(DataParser::getArray()))."','"
            .date("Y-m-d H:i:s",time())."','0','".UserHelper::GetUserIP()."', {{%logcpuload%}}, '{{%loghostname%}}', '".APIID."')";

        Logger::writeApiLogFile($sql."\n----\n");
    }

    static function writeApiLogFile($sql) {
        if(!API_REQUEST_GUID) return false;
        if(API_REQUEST_GUID == "API_REQUEST_GUID") return false;
        $logFilePath = LOG_PATH."/api_log_queries/".API_REQUEST_GUID.".csv";
        file_put_contents($logFilePath, $sql, FILE_APPEND);
    }

    function registerHookedClass($class){
        Logger::getInstance()->hookedClasses[] = $class;
    }

    static public function registerBackgroundFunction($jobId){
        Logger::getInstance()->backgroundFunctions[] = $jobId;
    }

    static public function saveErrorToLog($subject, $reportContent) {

        $date                       = gmdate('Y-m-d H:i:s');
        $data                       = "\n!$date||$subject\n<\n$reportContent\n>";

        file_put_contents(LOG_PATH.'/errors.log', $data, FILE_APPEND);
    }

    static public function sendAPINotification($channelID, $subject, $reportContent) {

        if(defined('ERRORS_LOG') && ERRORS_LOG) {
            self::saveErrorToLog($subject, $reportContent);
        }

        if(defined('NOTIFICATIONS_HOOK_URL') && NOTIFICATIONS_HOOK_URL[$channelID]) {
            $url                    = "https://hooks.slack.com/services/".NOTIFICATIONS_HOOK_URL[$channelID];
        } else {
            return false;
        }


        $post                       = $_POST;

        // hiding sensitive information to not expose it in the notification
        if(!empty($post['password'])) {
            $post['password']       = '***';
        }

        if(array_key_exists('pin', $post)) {
            $post['pin']            = '***';
        }

        $get                        = $_GET;

        $reportContent              = $reportContent.
                                    "\n\nDate: ".date("Y-m-d H:i:s e", time()).
                                    "\n\n_POST: ".serialize($post).
                                    "\n\n_GET: ".serialize($get).
                                    "\n\n_FILES: ".serialize($_FILES).
                                    "\n\nServer Hostname: ".gethostname();

        $ch                         = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
            'text' => "*".$subject."*\n".$reportContent
        )));

        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);

        curl_exec($ch);

        return true;
    }

    public static function getInstance()
    {
        if (!is_object(self::$_instance)) {
            self::$_instance = new Logger();
        }
        return self::$_instance;
    }


    private function logs_to_scv(array $Fields, string $table, string $api_log_guid )
    {
//        $outputFile = LOG_PATH."/api_log_queries/".$table."/".API_REQUEST_GUID.".csv";
//        $outputFile = LOG_PATH."/api_log_queries/".$table."/api_sql_logs.csv";
        $outputFile = LOG_PATH."/api_log_queries/".$table."/".$api_log_guid.".csv";
//        $outputFile = "/s3-api-exp-sql-logs/".$table."/".$api_log_guid.".csv";

        $fpOut = fopen($outputFile, "a");
        fputcsv($fpOut, $Fields, '#');
        fclose($fpOut);
    }



    public static function Write($session, $method, $resource, $params, $date, $time, $code, $text, $resourceFile)
    {
        return Logger::getInstance()->_write($session, $method, $resource, $params, $date, $time, $code, $text, $resourceFile);
    }
}
