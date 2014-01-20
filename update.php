<?php

//code below is simplified - in real app you will want to have some kins session based autorization and input value checking
error_reporting(E_ALL ^ E_NOTICE);

//include db connection settings

require_once('config.php');
require_once('common.php');

function add_row($rowId) {
    global $newId;

    $sql = "INSERT INTO " . DB_TABLE . "(
                        operator,sender,receiver,sms,is_valid,created_at)
			VALUES (
					'" . addslashes($_POST[$rowId . "_c1"]) . "',
					'" . addslashes($_POST[$rowId . "_c2"]) . "',
					'" . $_POST[$rowId . "_c3"] . "',
					'" . $_POST[$rowId . "_c4"] . "',
					'" . $_POST[$rowId . "_c5"] . "',
					'" . $_POST[$rowId . "_c6"] . "')";
    $res = mysql_query($sql);
    //set value to use in response
    $newId = mysql_insert_id();
    return "insert";
}

function update_row($rowId) {
    $sql = "UPDATE " . DB_TABLE . " SET  
				operator=		'" . addslashes($_POST[$rowId . "_c1"]) . "',
				sender=		'" . addslashes($_POST[$rowId . "_c2"]) . "',
				receiver=		'" . $_POST[$rowId . "_c3"] . "',
				sms=	'" . $_POST[$rowId . "_c4"] . "',
				cnt=	'" . $_POST[$rowId . "_c5"] . "',
				is_valid=	'" . $_POST[$rowId . "_c6"] . "',
				created_at=	'" . $_POST[$rowId . "_c7"] . "'
			WHERE id=" . $rowId;
    $res = mysql_query($sql);

    echo $sql;

    return "update";
}

function delete_row($rowId) {

    $d_sql = "DELETE FROM " . DB_TABLE . " WHERE id=" . $rowId;
    $resDel = mysql_query($d_sql);
    return "delete";
}

//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may differ in your case
echo('<?xml version="1.0" encoding="iso-8859-1"?>');
//output update results
echo "<data>";


$ids = explode(",", $_POST["ids"]);
//for each row
for ($i = 0; $i < sizeof($ids); $i++) {
    $rowId = $ids[$i]; //id or row which was updated
    $newId = $rowId; //will be used for insert operation
    $mode = $_POST[$rowId . "_!nativeeditor_status"]; //get request mode

    switch ($mode) {
        case "inserted":
            //row adding request
            $action = add_row($rowId);
            break;
        case "deleted":
            //row deleting request
            $action = delete_row($rowId);
            break;
        default:
            //row updating request
            $action = update_row($rowId);
            break;
    }
    echo "<action type='" . $action . "' sid='" . $rowId . "' tid='" . $newId . "'/>";
}

echo "</data>";
?>