<?php

require_once 'db_pdo.php';
class products
{
    public function product_display()
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

    public function product_List()
    {
        // echo 'skkkskkskskkskkskkskkskskk';
        $db = new db_pdo();
        $products = $db->querySelect('select * from products');
        // print_r($products);
        //     $products = [
        //     [
        //         'id' => 0,
        //         'name' => 'Red Jersey',
        //         'description' => 'Manchester United Home Jersey, red, sponsored by Chevrolet',
        //         'price' => 59.99,
        //         'pic' => 'red_jersey.jpg',
        //         'qty_in_stock' => 200,
        //     ],
        //     [
        //         'id' => 1,
        //         'name' => 'White Jersey',
        //         'description' => 'Manchester United Away Jersey, white, sponsored by Chevrolet',
        //         'price' => 49.99,
        //         'pic' => 'white_jersey.jpg',
        //         'qty_in_stock' => 133,
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Black Jersey',
        //         'description' => 'Manchester United Extra Jersey, black, sponsored by Chevrolet',
        //         'price' => 54.99,
        //         'pic' => 'black_jersey.jpg',
        //         'qty_in_stock' => 544,
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Blue Jacket',
        //         'description' => 'Blue Jacket for cold and raniy weather',
        //         'price' => 129.99,
        //         'pic' => 'blue_jacket.jpg',
        //         'qty_in_stock' => 14,
        //     ],
        //     [
        //         'id' => 4,
        //         'name' => 'Snapback Cap',
        //         'description' => 'Manchester United New Era Snapback Cap- Adult',
        //         'price' => 24.99,
        //         'pic' => 'cap.jpg',
        //         'qty_in_stock' => 655,
        //     ],
        //     [
        //         'id' => 5,
        //         'name' => 'Champion Flag',
        //         'description' => 'Manchester United Champions League Flag',
        //         'price' => 24.99,
        //         'pic' => 'champion_league_flag.jpg',
        //         'qty_in_stock' => 321,
        //     ],
        // ];
        $page = new web_page();
        // $page->title = $products['name'];
        $user = new users();
        $page->context = $user->table_display($products);
        // $this->context=array_to_html_table($product);
        $page->render();
    }

    public function product_Catalogue()
    {
        $db = new db_pdo();
        $products = $db->querySelect('select * from products');
        //     $products = [
        //     [
        //         'id' => 0,
        //         'name' => 'Red Jersey',
        //         'description' => 'Manchester United Home Jersey, red, sponsored by Chevrolet',
        //         'price' => 59.99,
        //         'pic' => 'red_jersey.jpg',
        //         'qty_in_stock' => 200,
        //     ],
        //     [
        //         'id' => 1,
        //         'name' => 'White Jersey',
        //         'description' => 'Manchester United Away Jersey, white, sponsored by Chevrolet',
        //         'price' => 49.99,
        //         'pic' => 'white_jersey.jpg',
        //         'qty_in_stock' => 133,
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Black Jersey',
        //         'description' => 'Manchester United Extra Jersey, black, sponsored by Chevrolet',
        //         'price' => 54.99,
        //         'pic' => 'black_jersey.jpg',
        //         'qty_in_stock' => 544,
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Blue Jacket',
        //         'description' => 'Blue Jacket for cold and raniy weather',
        //         'price' => 129.99,
        //         'pic' => 'blue_jacket.jpg',
        //         'qty_in_stock' => 14,
        //     ],
        //     [
        //         'id' => 4,
        //         'name' => 'Snapback Cap',
        //         'description' => 'Manchester United New Era Snapback Cap- Adult',
        //         'price' => 24.99,
        //         'pic' => 'cap.jpg',
        //         'qty_in_stock' => 655,
        //     ],
        //     [
        //         'id' => 5,
        //         'name' => 'Champion Flag',
        //         'description' => 'Manchester United Champions League Flag',
        //         'price' => 24.99,
        //         'pic' => 'champion_league_flag.jpg',
        //         'qty_in_stock' => 321,
        //     ],
        // ];
        $page = new web_page();
        // $page->title = $products['name'];

        $page->context = array_to_html_table3($products);
        // $this->context=array_to_html_table($product);
        $page->render();
    }

    public function search()
    {
        $find = $_POST['search'];
        $db = new db_pdo();
        // $sql_str='select * from products where id=:id_input';
        // $params=
        $products = $db->querySelect("select * from products where id like '%$find%'");
        if (count($products) == 0) {
            echo 'no products found';
        }
        $page = new web_page();
        // $page->title = $products['name'];
        $page->context = array_to_html_table3($products);
        // $this->context=array_to_html_table($product);
        $page->render();
    }

    public function ProductsWebservice()
    {
        $db = new db_pdo();
        $products = $db->table('products');
        $productsJson = json_encode($products, JSON_PRETTY_PRINT);
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

    public function array_push_assoc($array, $key, $value)
    {
        $array[$key] = $value;

        return $array;
    }

    public function ProductUpdatePage()
    {
        $id = $_GET['id'];
        $db = new db_pdo();
        $products = $db->querySelect('select * from products');
        foreach ($products as $product) {
            if ($product['id'] == $id) {
                $LoginPage = new web_page();
                $LoginPage->context = <<<HTML
        <div style="height:500px;width:300px;border:1px solid black;background:lightgreen;margin:auto">        
        <img style="height:200px;width:200px;margin:auto;" src="productimages/{$product['pic']}">
    <form enctype="multipart/form-data" method="POST" action="index.php?op=117">
    <!-- <input type="hidden" name="op" value="2"> -->
    <input type="file" value="choose file" name="user_pic"><br>
    Name<br><input type="text" name="pname" required maxlength="50" size="25" value="{$product['name']}"><br>
    Description<br><input type="text" name="pdescription" maxlength="50" value="{$product['description']}"><br>
    Price<br><input type="number" name="pprice" maxlength="50" value="{$product['price']}"><br>
    <input type="hidden" name="pid" value="{$product['id']}">
    Quantity<br><input type="number" name="pquantity" maxlength="50" value="{$product['qty_in_stock']}"><br>
    <input type="submit" value="Submit">
    </form>
            </div>
    HTML;
                $LoginPage->render();
            }
        }
    }

    public function ProductUpdatePage2()
    {
        $id = $_POST['pid'];
        $name = $_POST['pname'];
        $des = $_POST['pdescription'];
        $price = $_POST['pprice'];
        $quan = $_POST['pquantity'];
        // $pic = $_POST['user_pic'];
        $db = new db_pdo();
        $err_msg = '';
        // $db->query("UPDATE products SET name='$name',description='$des',price='$price',qty_in_stock='$quan' where id='$id'");
        $result = Picture_Save_File('user_pic', 'productimages/');
        $file_name = basename($_FILES['user_pic']['name']);
        if ($file_name == '') {
            $db->query("UPDATE products SET name='$name',description='$des',price='$price',qty_in_stock='$quan' where id='$id'");
            $this->product_Catalogue();
        } else {
            $db->query("UPDATE products SET name='$name',description='$des',price='$price',qty_in_stock='$quan',pic='$file_name' where id='$id'");
            $this->product_Catalogue();
        }
    }
}
