<?php

require_once 'web_page.php';
$a = 23;
$b = '23';
if ($a == $b) {
    echo 'test';
}
$change = ['id' => 0,
    'name' => 'black dress',
    'description' => 'lit black evening dress',
    'price' => 12,
];

function Homepage()
{
}

$home_page = new web_page();
$home_page->testarray = $change;
$home_page->title = 'Electronic scooter.com';
$home_page->context = '';
$home_page->render();
// $home_page->ADMIN_EMAIL = $COMPANY_EMIAL;
