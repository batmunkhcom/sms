<?php

require_once('config.php');
require_once('common.php');


if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 1;
}
if ($_GET['limit'] > 20) {
    $limit = 20;
}


switch ($_GET['type']) {
    case 'topsender':

        $allSms = getTopSenders($limit);

        for ($i = 0; $i < mysql_num_rows($allSms); $i++) {
            echo mysql_result($allSms, $i, "sender");
            //. '('.mysql_result($allSms, $i, "cnt").'), ';
        }
        break;
    case 'top1':

        $allSms = selectWinner('a', $limit);

        for ($i = 0; $i < mysql_num_rows($allSms); $i++) {
            echo mysql_result($allSms, $i, "phone") . ', ';
        }
        break;
    case 'top2':

        $allSms = selectWinner('b', $limit);

        for ($i = 0; $i < mysql_num_rows($allSms); $i++) {
            echo mysql_result($allSms, $i, "phone") . ', ';
        }
        break;
}