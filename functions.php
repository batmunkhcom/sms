<?php


function isValid($string) {

    $val = $GLOBALS['validation_strings'];

    $s = explode(" ", $string);

    if(substr_count($s[1], '.')>0) return false;
    if(substr_count($s[1], ',')>0) return false;
    if($s[1]{0} == 0) return false;
    
    //ehnii ugiig shalgaj bna. 2 dahi n ug bh yostoi.
    if (in_array(strtolower($s[0]), $val[1]) && (int)$s[1] > 0) {

        return 1;
    }

    return 0;
}