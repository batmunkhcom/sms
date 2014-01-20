<?php

$top1 = file_get_contents('http://www.yourdomain.com/sms/api.php?type=top1&limit=10');
$top1 = rtrim($top1, ', ');
$phones = explode(', ', $top1);
foreach ($phones as $k => $v) {

    $v{6} = '*';
    $v{7} = '*';
    echo ($k + 1) . '. ' . $v . '<br />';
}
?>
