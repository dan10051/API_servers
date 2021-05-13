CREATE EXTERNAL TABLE IF NOT EXISTS api_sys_log (

  api_sessions_id STRING,
  method STRING,
  resource STRING,
  params STRING,
  `date` DATE,
  execution_time INT,
  response_code INT,
  response_text STRING,
  user_ip STRING,
  SQLexecuted INT,
  SQLreadFromCache INT,
  resource_file STRING
  )
  ROW FORMAT DELIMITED
  FIELDS TERMINATED BY ','
  LINES TERMINATED BY '\n'
  LOCATION 's3://api-exp-sql-logs/api_sys_log/';


  CREATE EXTERNAL TABLE IF NOT EXISTS api_sys_log (

    api_sessions_id STRING,
    method STRING,
    resource STRING,
    `date` STRING,
    response_code INT,
    response_text STRING,
    user_ip STRING,
    SQLexecuted INT,
    SQLreadFromCache INT,
    params STRING
    )
    ROW FORMAT DELIMITED
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    LOCATION 's3://api-exp-sql-logs/api_sys_log/';



    CREATE EXTERNAL TABLE IF NOT EXISTS api_resources_hooked_classes (

      api_sessions_id STRING,
      order INT,
      class STRING
      )
      ROW FORMAT DELIMITED
      FIELDS TERMINATED BY '\t'
      LINES TERMINATED BY '\n'
      LOCATION 's3://api-exp-sql-logs/Experimental/api_resources_hooked_classes/';



      CREATE EXTERNAL TABLE IF NOT EXISTS api_resources_background_functions (

        api_sessions_id STRING,
        order INT,
        jobId STRING
        )
        ROW FORMAT DELIMITED
        FIELDS TERMINATED BY '\t'
        LINES TERMINATED BY '\n'
        LOCATION 's3://api-exp-sql-logs/Experimental/api_resources_background_functions/';


        CREATE EXTERNAL TABLE IF NOT EXISTS api_resources_sql_queries (

          api_sessions_id STRING,
          order INT,
          type STRING,
          query STRING,
          debug_backtrace INT,
          query_md5 STRING,
          debug_backtrace_md5 STRING,
          SQLerror STRING,
          success INT,
          tte STRING,
          timestamp STRING,
          fromCache STRING,
          server STRING
          )
          ROW FORMAT DELIMITED
          FIELDS TERMINATED BY '\t'
          LINES TERMINATED BY '\n'
          LOCATION 's3://api-exp-sql-logs/Experimental/api_resources_sql_queries/';

          CREATE EXTERNAL TABLE api_resources_sql_queries (
            api_log_id STRING, order INT,
            type STRING, query STRING,
            debug_backtrace STRING,
            query_md5 STRING,
            debug_backtrace_md5 STRING,
            SQLerror STRING,
            success INT,
            tte INT,
            timestamp INT,
            fromCache INT,
            server STRING
) ROW FORMAT DELIMITED FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\n'
LOCATION 's3://api-exp-sql-logs/Experimental/api_resources_sql_queries/'
