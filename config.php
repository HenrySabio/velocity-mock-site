<?php 
// Local db settings
// DEFINE ('DB_USER', 'root');
// DEFINE ('DB_PASSWORD', '');
// DEFINE ('DB_HOST', 'localhost');
// DEFINE ('DB_NAME', 'velocity-db');

//     $dbci = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//     $dbci->set_charset("utf8");

//      if(!$dbci) {
//          die('Connection Failed:'.mysqli_connect_error());
//      }
//      global $dbci;

//Get Heroku ClearDB connection information
$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server   = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db       = substr($cleardb_url["path"],1);


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'    => '',
    'hostname' => $cleardb_server,
    'username' => $cleardb_username,
    'password' => $cleardb_password,
    'database' => $cleardb_db,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    // 'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $dbci = new mysqli($server, $username, $password, $db);

    global $dbci;
?>