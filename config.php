<?php
// Database Variables
define('HOST', 'localhost');
define('USER', 'root');
define('PWD', '');
define('DB', 'gfedb');

// General Variables
define('FOLDER', 'Educare');
define('TITLE', 'EDU CARE');

$host = $_SERVER['HTTP_HOST'];

define('SITE_URL', $host == 'localhost' ? 'http://' . $host . '/' . FOLDER . '/' : 'https://' . $host . '/' . FOLDER . '/');
