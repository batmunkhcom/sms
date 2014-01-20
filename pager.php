<?php

require_once('config.php');
require_once('common.php');

//IP avah
$ip = getenv('REMOTE_ADDR');

//operator iin utguudiig zadlah
$params = $smsGateways[$ip];

if (!isset($smsGateways[$ip])) {
    die('Zuvshuurulgui handalt....');
}

$is_valid = isValid($_GET[$params['sms']]);

mysql_query("INSERT INTO
    " . DB_TABLE . "(sender,receiver,sms,operator,created_at,ip,is_valid)
    VALUES('" . addslashes($_GET[$params['sender']]) . "',
            '" . addslashes($_GET[$params['receiver']]) . "',
            '" . addslashes($_GET[$params['sms']]) . "',
            '" . addslashes($params['operator']) . "',
            NOW(),
            '" . $ip . "',
            '" . $is_valid . "');")
        or die('Aldaa garlaa');



//hichneen msg ilgeesniig toolno. 
$update_count = mysql_query("SELECT MAX(cnt) FROM " . DB_TABLE . " WHERE sender='" . addslashes($_GET[$params['sender']]) . "'");
mysql_query("UPDATE " . DB_TABLE . " SET cnt='" . (mysql_result($update_count, 0) + 1) . "' WHERE sender='" . addslashes($_GET[$params['sender']]) . "'");



//hergelegchid butsaaj ilgeeh msg
if ($is_valid == 1) {
    
    
    echo addValidatedRecord(array(
                'sms' => $_GET[$params['sms']],
                'phone' => $_GET[$params['sender']]
            ));
} else {
    echo DEFAULT_REPLY_INVALID;
}
