<?php

require_once 'db_pdo.php';
require_once 'tools.php';

class users
{
    public function RegisterPage($err_msg = '', $prev_values = [])
    {
        if ($err_msg != '') {
            echo $err_msg;
        }
        if ($prev_values == []) {
            // initial values first time display
            $prev_values['email'] = '';
            $prev_values['pw'] = '';
        }
        $LoginPage = new web_page();
        //$LoginPage->title = 'Please login';
        $LoginPage->context = <<<HTML
        <div style="colo:red">{$err_msg}</div>
    <form enctype="multipart/form-data" method="POST" action="index.php?op=4">
    <!-- <input type="hidden" name="op" value="2"> -->
    Name:<br><input type="text" name="fullname" required maxlength="50" size="25" value="{$prev_values['email']}"><br>
    Address Line 1<br><input type="address" name="address_line1" maxlength="50" value="{$prev_values['pw']}"><br>
    Address Line 2<br><input type="address" name="address_line2" maxlength="50" value="{$prev_values['pw']}"><br>
    City<br><input type="text" name="city" maxlength="50" value="{$prev_values['pw']}"><br>
    Province<br><input type="text" name="province" maxlength="50" value="{$prev_values['pw']}"><br>
    Postal_code<br><input type="text" name="postal_code" value="{$prev_values['pw']}"><br>
    Language<br>
    English<input type="radio" name="english" maxlength="50" value="english"><br>
    French<input type="radio" name="french" maxlength="50" value="french"><br>
    Other Language<input type="radio" name="french" value="english"><br>
    <input type="file" value="choose file" name="user_pic">
    <!-- <select class="form-control" name="interests[]" multiple size="3">
            <option value="se">scooter électrique</option>
            <option value="sg">scooter à essence</option>
            <option value="velo_el">vélo électrique</option>
            <option value="velo">velo régulier</option>
            <option value="moto">moto</option>
        </select> -->
    <br>Email<br><input type="email" name="email" maxlength="126" value="{$prev_values['pw']}"><br>
    Password<br><input type="password" name="pw1" maxlength="8" value="{$prev_values['pw']}"><br>
    Confirm Password<br><input type="password" name="pw2" maxlength="8" value="{$prev_values['pw']}"><br>
    <input type="submit" value="Submit">
    </form>
    HTML;
        $LoginPage->render();
    }

    public function registerPageVerify()
    {
        $db = new db_pdo();
        $users = $db->querySelect('select * from users');
        // $users = [['id' => 0, 'name' => 'guri', 'email' => 'gurbhejsinghkang@gmail.com', 'password' => 'jaggi', 'user_level' => 'customer'],
        // ['id' => 0, 'name' => 'guri', 'email' => 'garrysinghkang@gmail.com', 'password' => 'jaggi', 'user_level' => 'employee'],
        // ['id' => 0, 'name' => 'guri', 'email' => 'gurisinghkang@gmail.com', 'password' => 'jaggi'], ];
        $err_msg = '';
        // echo 'hellelllelel';
        $find = false;
        $name = $_POST['fullname'];
        $address1 = $_POST['fullname'];
        $address2 = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['pw1'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $postalcode = $_POST['postal_code'];
        //  $file_input = $_POST['myfile'];
        $target_dir = 'usermages/';
        foreach ($users as $us) {
            if ($us['email'] == $_POST['email']) {
                $err_msg .= 'email already exist';
            }
        }
        // if ($_POST['pw1'] != $_POST['pw2']) {
        //     $err_msg .= 'password and confirm password does not match';
        // }
        if ($err_msg != '') {
            header('Location: http://w12-php/?op=3');
        } else {
            $result = Picture_Save_File('user_pic', 'usermages/');
            if ($result == 'ok') {
                $file_name = basename($_FILES['user_pic']['name']);
                $db = new db_pdo();
                $db->query("insert into users(name,email,pw,address_line1,
        address_line2,city,province,pic) values('$name','$email','$password','$address1','$address2','$city','$province','$file_name')");
            } else {
                $err_msg .= $result;
                $this->RegisterPage($err_msg);
            }
            //oginPage();
        }

        // if ($err_msg = '') {
    // }
    // // echo $err_msg;
    // if ($err_msg != '') {
    //     loginPage($err_msg);
    // }
    }

    public function loginPage($err_msg = '', $prev_values = [])
    {
        if ($err_msg != '') {
            echo $err_msg;
        }
        if ($prev_values == []) {
            // initial values first time display
            $prev_values['email'] = '';
            $prev_values['pw'] = '';
        }
        $LoginPage = new web_page();
        // $LoginPage->title = 'Please login';
        $LoginPage->context = <<<HTML
        <div style="colo:red">{$err_msg}</div>
    <form action="index.php?op=15" method="POST">
    <!-- <input type="hidden" name="op" value="2"> -->
    Email<input type="email" name="email" maxlength="50" value="{$prev_values['pw']}"><br>
    Password<input type="password" name="pw2" maxlength="50" value="{$prev_values['pw']}"><br>
    <input type="submit" value="Submit">
    </form>
    HTML;
        $LoginPage->render();
    }

    public function loginPageVerify()
    {
        $db = new db_pdo();
        $users = $db->querySelect('select * from users');
        //     $users = [['id' => 0, 'name' => 'guri', 'email' => 'gurbhejsinghkang@gmail.com', 'password' => 'jaggi', 'user_level' => 'customer'],
        // ['id' => 0, 'name' => 'guri', 'email' => 'garrysinghkang@gmail.com', 'password' => 'jaggi', 'user_level' => 'employee'],
        // ['id' => 0, 'name' => 'guri', 'email' => 'gurisinghkang@gmail.com', 'password' => 'jaggi'], ];
        $err_msg = '';
        $find = false;
        foreach ($users as $us) {
            if ($us['email'] == $_POST['email']) {
                // $err_msg .= 'email already exist';
                $_SESSION['user_connected'] = true;
                $_SESSION['user_email'] = $us['email'];
                $_SESSION['user_name'] = $us['name'];
                $_SESSION['user_id'] = $us['id'];
                $_SESSION['user_level'] = $us['user_level'];
                $_SESSION['user_pic'] = $us['pic'];
                header('Location: http://w12-php/?op=110');
            }
        }
        if ($err_msg = '') {
        }
        // echo $err_msg;
        if ($err_msg != '') {
            loginPage($err_msg);
        }
        if ($find == true) {
        } else {
            if (!isset($_SESSION['login_count'])) {
                $_SESSION['login_count'] = 1;
            } else {
                ++$_SESSION['login_count'];
            }
        }
        if ($_SESSION['login_count'] == 5) {
            $page = new web_page();
            $page->title = 'U are blocked';
            $page->context = 'U have reached the max login limit';
        } else {
        }
    }

    public function logOut()
    {
        $_SESSION['user_name'] = null;
        $_SESSION['user_email'] = null;
        $_SESSION['user_id'] = null;
        $_SESSION['user_connected'] = false;
        header('Location: http://w12-php/?op=110');
    }

    public function table_display($table)
    {
        $out = '';
        $out = '<style> td,th{border: solid 2px black;}</style>';
        if (count($table) == 0) {
            //table is empty
            return 'table is empty';
        }
        $out .= '<table>';

        //table header
        $col_names = array_keys($table[0]);
        // echo 'hellloskkkkkkkkkkkkkkkkkkkkkkkkkkkkkk';
        // print_r($col_names);
        $out .= '<tr>';
        foreach ($col_names as $col_name) {
            $out .= '<th>'.$col_name.'</th>';
        }
        $out .= '</tr>';
        //table data
        $out .= '</tr>';
        foreach ($table as $one_row) {
            $out .= '<tr>';
            foreach ($one_row as $key => $col_name) {
                if ($key == 'price') {
                    $out .= '<td> $'.$col_name.' </td>';
                } else {
                    $out .= '<td>'.$col_name.' </td>';
                }
            }
            $out .= '</tr>';
        }
        $out .= '</table>';

        return $out;
    }

    public function UsersWebservice()
    {
        $db = new db_pdo();
        $users = $db->table('users');
        $productsJson = json_encode($users, JSON_PRETTY_PRINT);
        $content_type = 'Content-Type: application/json;charset=UTF-8';
        header($content_type);
        http_response_code(200);
        echo $productsJson;
        // $product = $db->table('products');
        // $productJson = json_encode($product, JSON_PRETTY_PRINT);
        // $content_type = 'Content-Type: application/json; charset=UTF-8';
        // header($content_type);
        // http_response_code(200);
        // echo $productJson;
    }
}
