<?php

require_once '../vendor/autoload.php';

use SDK\Factory;

$configs = [
    'USER' => 'dongpeng@pstech360.com',
    'UKEY' => 'hkZGgUmNTJNHybVM',
];
$feie = Factory::Feie($configs);
$res = $feie->printer->post('Open_printMsg', []);
var_dump($res);
$b = 1;
