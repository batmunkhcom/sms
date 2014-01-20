<?php

$config['dir'] = '';

$config['db_host'] = 'localhost';
$config['db_name'] = 'dbname';
$config['db_user'] = 'dbuser';
$config['db_pass'] = 'dbpass';
$config['db_table'] = 'sms';
$config['db_table_validated'] = 'validated';

//txt tohirgoo
$config['REPLY_DEFAULT_TXT'] = 'Tanii sanliig huleej avlaa. www.yourdomain.com huudasnaas ur dungee shalgaarai.';
$config['REPLY_HIGHER_THAN_WINNER_DUPLICATED'] = 'Tanii sanal odoogiin yalagchiin sanalaas ih, davhardsan bna. www.yourdomain.com huudasnaas ur dungee shalgaarai.';
$config['REPLY_HIGHER_THAN_WINNER'] = 'Tanii sanal odoogiin yalagchiin sanalaas ih bna. www.yourdomain.com huudasnaas ur dungee shalgaarai.';
$config['REPLY_WINNER_DUPLICATED'] = 'Tanii sanal yalagchtai davhardlaa. www.yourdomain.com huudasnaas ur dungee shalgaarai.';
$config['REPLY_LOWER_THAN_WINNER_DUPLICATED'] = 'Tanii sanal odoogiin yalagchiin sanalaas baga, gehdee davhardsan bna. www.yourdomain.com huudasnaas ur dungee shalgaarai.';
$config['DEFAULT_REPLY_INVALID'] = 'Uuchlaarai. Tanii sanal aldaatai baina. Shalgaad dahin ilgeene uu. Jishee ni: A 123 Gehdee tanii ilgeesen sms buhen iPad uraldaand tootsogdono.';
$config['REPLY_YOU_ARE_CURRENT_WINNER'] = 'Bayar hurgeye. Ta odoogoor yalagchaar todrood bna. www.yourdomain.com huudasnaas ur dungee shalgaarai.';


$users = array(
    'admin'=>'adminpass',
    'mbm'=>'mypass'
);

$validation_strings[1] = array('a','b');
$validation_strings[2] = null;

$smsGateways  = array(
    '202.179.31.4'=>array(
        //sms gateway server ip
        'operator'=>'mbm',
        //sms ilgeegch utasnii dugaariig todorhoiloh huvisagch. 99088033 geh met
        'sender'=>'sender',
        //tusgai dugaariin parameter 151234 geh met
        'receiver'=>'receiver',
        'sms'=>'sms'
    ),
    '202.70.46.84'=>array(
        //sms gateway server ip
        'operator'=>'unitel',
        //sms ilgeegch utasnii dugaariig todorhoiloh huvisagch. 99088033 geh met
        'sender'=>'sender',
        //tusgai dugaariin parameter 151234 geh met
        'receiver'=>'receiver',
        'sms'=>'sms'
    ),
    '202.55.180.39'=>array(
        'operator'=>'skytel',
        'sender'=>'sender',
        'receiver'=>'receiver',
        'sms'=>'sms'
    ),

    '203.91.114.40'=>array(
        'operator'=>'gmobile',
        'sender'=>'sender',
        'receiver'=>'receiver',
        'sms'=>'sms'
    ),
    '27.123.214.162'=>array(
        'operator'=>'mobicom',
        'sender'=>'sender',
        'receiver'=>'receiver',
        'sms'=>'sms'
    ),
);

foreach($config as $k=>$v){
    define(strtoupper($k),$v);
}