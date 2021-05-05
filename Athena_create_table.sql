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
    FIELDS TERMINATED BY '#'
    LINES TERMINATED BY '\n'
    LOCATION 's3://api-exp-sql-logs/api_sys_log/';
