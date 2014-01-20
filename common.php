<?php


$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);

mysql_select_db(DB_NAME, $link);

session_start();

require_once('functions.php');
require_once('model.php');
