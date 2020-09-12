<?php

$db_host = 'localhost';
$db_user_name = 'electric_scooter';
$db_name = 'electric_scooter';
$db_user_pw = 'Kang@123456789';

function func()
{
    $db_host = 'localhost';
    $db_user_name = 'electric_scooter';
    $db_name = 'electric_scooter';
    $db_user_pw = 'Kang@123456789';
    try {
        $connection = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user_name, $db_user_pw);
    } catch (PDOException $e) {
        echo 'Error!: '.$e->getMessage().'<br/>';
        die();
    }
    echo 'connected';
}
func();
