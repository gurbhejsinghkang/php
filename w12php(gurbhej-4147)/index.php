<?php

session_start();
require_once 'web_page.php';

require_once 'tools.php';

require_once 'products.php';
require_once 'users.php';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = 0;
}
switch ($op) {
    case 0:
        HomePage();
    break;

    case 100:
        $pro = new products();
        $pro->product_display();
    break;
    case 10:
        $pro = new products();
        $pro->search();
    break;
    case 110:
        // echo 'hello';
        $pro = new products();
        // $pro = new products();
        $pro->product_List();
    break;
    case 111:
        $pro = new products();
        $pro->product_Catalogue();
    break;
    case 3:
        $user = new users();
        $user->RegisterPage();
    break;
    case 4:
        $user = new users();
        $user->registerPageVerify();
         // $pro = new products();

     break;
    // case 4:
    //     $user = new users();
    //     $user->loginPage();
    break;
    case 110:
        echo 'hello';
        $pro = new products();
        // $pro = new products();
        $pro->product_List();
    break;
    case 12:
        if (isset($_SESSION['login_count']) > 3) {
            $page = new web_page();
            $page->title = 'u are blocked';
            $page->context = 'You have reached the max login limit';
        } else {
            $user = new users();
            $user->loginPage();
        }
        // $pro = new products();
    break;
    // case 15:
    //     $user = new users();
    //     $user->UsersWebservice();
    // break;
    case 15:
        $user = new users();
        $user->loginPageVerify();
    break;
    case 50:
        //$user = new users();
        // $user->
        DisplayserverErrorLogs();
    break;
    case 5:
        $user = new users();
        $user->logout();
    break;
    case 1:
        // $user = new users();
        test();
    break;
    case 51:
        $db = new db_pdo();
        $users = $db->querySelect('select * from users');
        $html_table = table_display($users);
        $page = new web_page();
        $page->context = $html_table;
        $page->render();
    break;
    case 115:
        $prod = new products();
        $prod->ProductsWebservice();
    break;
    case 116:
        $prod = new products();
        $prod->ProductUpdatepage();
    break;
    case 117:
        $prod = new products();
        $prod->ProductUpdatepage2();
    break;
    default:
        crash(500, 'Sorry We have a problem');
        break;
}
function diaplayservererrorLogs()
{
    $page = new web_page();
    $page->title = 'Server error logs';
    $page->context = '';
    $page->render();
}
function product_display()
{
    // echo 'yes';
    $product = [
    'id' => 0,
    'name' => 'Black Dress',
    'descrition' => 'Little black evening dress',
    'price' => 99.99,
];
    $page = new web_page();
    $page->title = $product['name'];
    $page->description = 'Table Listing';
    $page->context = array_to_html_table($product);
    // $this->context=array_to_html_table($product);
    $page->render();
}
function product_List()
{
    $products = [
        [
            'id' => 0,
            'name' => 'Red Jersey',
            'description' => 'Manchester United Home Jersey, red, sponsored by Chevrolet',
            'price' => 59.99,
            'pic' => 'red_jersey.jpg',
            'qty_in_stock' => 200,
        ],
        [
            'id' => 1,
            'name' => 'White Jersey',
            'description' => 'Manchester United Away Jersey, white, sponsored by Chevrolet',
            'price' => 49.99,
            'pic' => 'white_jersey.jpg',
            'qty_in_stock' => 133,
        ],
        [
            'id' => 2,
            'name' => 'Black Jersey',
            'description' => 'Manchester United Extra Jersey, black, sponsored by Chevrolet',
            'price' => 54.99,
            'pic' => 'black_jersey.jpg',
            'qty_in_stock' => 544,
        ],
        [
            'id' => 3,
            'name' => 'Blue Jacket',
            'description' => 'Blue Jacket for cold and raniy weather',
            'price' => 129.99,
            'pic' => 'blue_jacket.jpg',
            'qty_in_stock' => 14,
        ],
        [
            'id' => 4,
            'name' => 'Snapback Cap',
            'description' => 'Manchester United New Era Snapback Cap- Adult',
            'price' => 24.99,
            'pic' => 'cap.jpg',
            'qty_in_stock' => 655,
        ],
        [
            'id' => 5,
            'name' => 'Champion Flag',
            'description' => 'Manchester United Champions League Flag',
            'price' => 24.99,
            'pic' => 'champion_league_flag.jpg',
            'qty_in_stock' => 321,
        ],
    ];
    $page = new web_page();
    // $page->title = $products['name'];
    $page->context = array_to_html_table2($products);
    // $this->context=array_to_html_table($product);
    $page->render();
}
function user_form()
{
    header('Location: http://w12-php/loginpage.php/');
}
function product_Catalogue()
{
    $products = [
        [
            'id' => 0,
            'name' => 'Red Jersey',
            'description' => 'Manchester United Home Jersey, red, sponsored by Chevrolet',
            'price' => 59.99,
            'pic' => 'red_jersey.jpg',
            'qty_in_stock' => 200,
        ],
        [
            'id' => 1,
            'name' => 'White Jersey',
            'description' => 'Manchester United Away Jersey, white, sponsored by Chevrolet',
            'price' => 49.99,
            'pic' => 'white_jersey.jpg',
            'qty_in_stock' => 133,
        ],
        [
            'id' => 2,
            'name' => 'Black Jersey',
            'description' => 'Manchester United Extra Jersey, black, sponsored by Chevrolet',
            'price' => 54.99,
            'pic' => 'black_jersey.jpg',
            'qty_in_stock' => 544,
        ],
        [
            'id' => 3,
            'name' => 'Blue Jacket',
            'description' => 'Blue Jacket for cold and raniy weather',
            'price' => 129.99,
            'pic' => 'blue_jacket.jpg',
            'qty_in_stock' => 14,
        ],
        [
            'id' => 4,
            'name' => 'Snapback Cap',
            'description' => 'Manchester United New Era Snapback Cap- Adult',
            'price' => 24.99,
            'pic' => 'cap.jpg',
            'qty_in_stock' => 655,
        ],
        [
            'id' => 5,
            'name' => 'Champion Flag',
            'description' => 'Manchester United Champions League Flag',
            'price' => 24.99,
            'pic' => 'champion_league_flag.jpg',
            'qty_in_stock' => 321,
        ],
    ];
    $page = new web_page();
    // $page->title = $products['name'];
    $page->context = array_to_html_table3($products);
    // $this->context=array_to_html_table($product);
    $page->render();
}
// function array_display($array_name)
// {
//     echo'<style> td,th{border:1px solid black;}</style>';
//     echo'<table>';
//     echo'<tr>';
//     echo'<th>index</th><th>Value</th>';
//     echo'</tr>';

//     foreach ($array_name as $key => $value) {
//         echo'<tr>';
//         echo'<td>'.$key.'</td>';
//         echo'<td>'.$value.'</td>';
//         echo'</tr>';
//     }
//     echo'</table>';
// }
// array_display($product);
// $winning_numbers = [33, 46, 23, 1, 67];
// array_display($winning_numbers);
//die();

require_once 'web_page.php';
function HomePage()
{
    $home_page = new web_page();

    $home_page->title = 'ElectricScooter.com Home-welcome!';
    $home_page->context = '<h1>welcome my frend!</h1>';
    $home_page->render();
}
HomePage();
echo 'test';
