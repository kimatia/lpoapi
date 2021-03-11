<?php

$host = getenv('MYSQL_HOST');
$dbname = getenv('MYSQL_DATABASE');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=lpo',
    'username' => 'dan',
    'password' => 'root',
    'charset' => 'utf8',
];