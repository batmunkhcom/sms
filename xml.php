<?php

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 1;
}
if ($_GET['limit'] > 20) {
    $limit = 20;
}

require_once('config.php');
require_once('common.php');

//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may differ in your case
echo('<?xml version="1.0" encoding="utf-8"?>');

echo '<data>';
echo '<rows id="0">';

switch ($_GET['type']) {
    case 'sms':
        $allSms = getAll();

        for ($i = 0; $i < mysql_num_rows($allSms); $i++) {
            print ("<row id='" . mysql_result($allSms, $i, "id") . "'>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "id") . "]]></cell>");
            print('<cell>' . mysql_result($allSms, $i, "operator") . '</cell>');
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "sender") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "receiver") . "]]></cell>");
            print("<cell><![CDATA[" . addslashes(mysql_result($allSms, $i, "sms") ). "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "cnt") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "is_valid") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "created_at") . "]]></cell>");
            print("</row>");
        }
        break;
    case 'valid1':
       
        $allSms = selectWinner('a', $limit);

        for ($i = 0; $i < mysql_num_rows($allSms); $i++) {
            print ("<row id='" . mysql_result($allSms, $i, "id") . "'>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "id") . "]]></cell>");
            print('<cell>' . mysql_result($allSms, $i, "phone") . '</cell>');
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "str1") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "str2") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "created_at") . "]]></cell>");
            print("</row>");
        }
        break;
    case 'valid2':
       
        $allSms = selectWinner('b', $limit);

        for ($i = 0; $i < mysql_num_rows($allSms); $i++) {
            print ("<row id='" . mysql_result($allSms, $i, "id") . "'>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "id") . "]]></cell>");
            print('<cell>' . mysql_result($allSms, $i, "phone") . '</cell>');
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "str1") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "str2") . "]]></cell>");
            print("<cell><![CDATA[" . mysql_result($allSms, $i, "created_at") . "]]></cell>");
            print("</row>");
        }
        break;
}

echo '</rows>';
echo '</data>';