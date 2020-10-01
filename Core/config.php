<?php
define('ENVIRONMENT', 'PRODUCTION');
define('DEFAULT_CONTROLLER', 'TaskController');
define('DEFAULT_ACTION', 'index');
define('VIEW_PATH', 'App/Views/');
define('TASKS_PER_PAGE', 3);


if (dirname($_SERVER['SCRIPT_NAME']) == '/') {
    define('ROUTE_PATH', '');

} else define('ROUTE_PATH', dirname($_SERVER['SCRIPT_NAME']));

if (getenv("CLEARDB_DATABASE_URL") !== false) {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    define('HOST', $url['host']);
    define('USERNAME', $url['user']);
    define('PASSWORD', $url['pass']);
    define('DBNAME', substr($url["path"], 1));
} else {
    define('HOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DBNAME', 'beejeett');

}



