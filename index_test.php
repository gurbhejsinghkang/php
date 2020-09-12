<?php

require_once 'db_pdo.php';
$db = new db_pdo();
$db->query('insert into users(name,email,pw,user_level) values("gurbhje","garrysinghkanh@gmail.com","djjdjjd","client")');
$users = $db->querySelect('select * from users');
var_dump($users);
$db->disconnect();
