<?php

function getAll($v='') {
    $q = "SELECT * FROM " . DB_TABLE . "  ";
    if (strlen($v) > 4) {
        $q .= $v . " ";
    }
    $q .= "ORDER BY (sms+0) ASC";
    $r = mysql_query($q);

    return $r;
}

function getAllValidated($v = '') {
    $q = "SELECT * FROM " . DB_TABLE_VALIDATED . " ";
    if (strlen($v) > 4) {
        $q .= $v . " ";
    }
    $q .= "ORDER BY id DESC";
    $r = mysql_query($q);

    return $r;
}

function isValidatedPhone($phone='') {
    $q = "SELECT * FROM " . DB_TABLE_VALIDATED . " WHERE phone='" . $phone . "' LIMIT 1";
    $r = mysql_query($q);

    if (mysql_num_rows($r) == 0) {

        return false;
    } else {

        return true;
    }
}

function addValidatedRecord($v = array(
    'sms' => '',
    'phone' => ''
)) {



    //ugsiig salgaj neg neg fielded oruulna. ene udaad ehnii 2 ugiig avch bna
    //sms iig zadlana
    $s = explode(" ", $v['sms']);



//yalagchiig songoh
    $theWinner = selectWinner(addslashes($s[0]), 1);
    mysql_query("
        INSERT INTO " . DB_TABLE_VALIDATED . "
            (phone,str1,str2,created_at) 
        VALUES
            ('" . $v['phone'] . "','" . addslashes($s[0]) . "','" . addslashes((int) $s[1]) . "',NOW())
        ");

    //davhardsan esehiig shalgana
    $q_check = "SELECT COUNT(*) FROM " . DB_TABLE_VALIDATED . " WHERE str1='" . addslashes(strtolower($s[0])) . "' AND str2='" . addslashes($s[1]) . "'";
    $r_check = mysql_query($q_check);
//
//    if (mysql_result($r_check, 0) > 1) {
//        return REPLY_LOWER_THAN_WINNER_DUPLICATED;
//    }

    //odoogiin yalagchaas ih bna
    if ((int) mysql_result($theWinner, 0, 'str2') < (int) $s[1]) {
        //davhardsan esehiig shalgana
        if (mysql_result($r_check, 0) > 1) {
            return REPLY_HIGHER_THAN_WINNER_DUPLICATED;
        } else {
            return REPLY_HIGHER_THAN_WINNER;
        }
    }

    //odoogiin yalagchaas baga bna. gehdee davhardsan davhardaagui bna
    if ((int) mysql_result($theWinner, 0, 'str2') > (int) $s[1]) {
        //davhardsan esehiig shalgana
        if (mysql_result($r_check, 0) > 1) {
            return REPLY_LOWER_THAN_WINNER_DUPLICATED;
        } else {
            return REPLY_LOWER_THAN_WINNER;
        }
    }

    //ta odoogiin yalagchaar todrood bna.
    if ((int) mysql_result($theWinner, 0, 'str2') == (int) $s[1]) {

        if (mysql_result($r_check, 0) > 1) {
            return REPLY_WINNER_DUPLICATED;
        } else {
            return REPLY_YOU_ARE_CURRENT_WINNER;
        }
    }



    return REPLY_DEFAULT_TXT;
}

function selectWinner($str1='', $limit = 1) {
    $q = "SELECT r.*, MIN(r.str2)
                FROM " . DB_TABLE_VALIDATED . " r
                WHERE lower(r.str1) = '" . $str1 . "' AND r.str2 NOT LIKE '0%' 
                GROUP BY r.str2, r.str2
                HAVING COUNT(*) = 1 
                ORDER BY (r.str2+0) ASC LIMIT " . $limit;
    $allSms = mysql_query($q);

//    echo $q;
    return $allSms;
}

function getTotalByOperator($op='') {
    $q = "SELECT COUNT(*) FROM " . DB_TABLE . " WHERE operator='" . $op . "'";
    $r = mysql_query($q);

    return mysql_result($r, 0);
}

function countOperators() {
    $q = "SELECT operator, COUNT( * ) AS op
                FROM  `" . DB_TABLE . "` 
                GROUP BY operator
                ORDER BY operator DESC";
    $r = mysql_query($q);

    return $r;
}

function getAllIsValid() {
    $q = "SELECT COUNT(*) FROM " . DB_TABLE . "  ";
    $q .= "WHERE is_valid=1 ";
    $r = mysql_query($q);

    return mysql_result($r, 0);
}

function getAllIsInValid() {
    $q = "SELECT COUNT(*) FROM " . DB_TABLE . "  ";
    $q .= "WHERE is_valid=0 ";
    $r = mysql_query($q);

    return mysql_result($r, 0);
}

function getFromValidated($str1='') {
    $q = "SELECT COUNT(*) FROM " . DB_TABLE_VALIDATED . "  ";
    $q .= "WHERE str1 LIKE '" . $str1 . "%' ";
    $r = mysql_query($q);

    return mysql_result($r, 0);
}

function getTopSenders($limit=10) {
    $q = "SELECT r.*
                FROM " . DB_TABLE . " r
                GROUP BY sender                
                ORDER BY cnt DESC LIMIT " . $limit;
    $allSms = mysql_query($q);

    return $allSms;
}