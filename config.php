<?php

$config['db']['host'] = 'localhost';
$config['db']['port'] = '3306';
$config['db']['username'] = 'rpcproleplay';
$config['db']['password'] = 'SaIh0nk)4bTW';
$config['db']['dbname'] = 'rpcproleplay';


$config['superAdmins'] = '1';

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP']; }