<?php

require_once 'global_defines.php';
class web_page extends ArrayObject
{
    public $testarray;
    public $title = 'welcome to elcrticscooter.com';
    public $description = '  elcrticscooter.com is a website where you can search various websites online, and book them .';

    public $author = 'Gurbhej Singh';

    // public $content = 'Gurbhej Singh say hello world';

    public $lang = 'en-CA';
    public $icon = 'my-icon.jpg';

    public function __construct()   //constructor
    {
        $this->testarray = [];
    }

    public function render()
    {
        // if ($this->context == '') {
        //     http_response_code(500);
        //     if (mail('gurbhej4321kang@gmail.com', 'hello', 'hello world')) {
        //         die('if');
        //     } else {
        //         die('else');
        //     }
        //     die;

        //     die('sorry we have a problem'); //stop the program
        // }?>

<!DOCTYPE html>
<html lang="<?=$this->lang; ?>">

<head>
    <meta charset="utf-8">

    <?=$this->title; ?>

    <meta name="description" value="<?=$this->description; ?>">
    <link rel="icon" href="<?=$this->icon; ?>">

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <head>

    <body>
        <header class="my-header">
            <span> THIS IS THE HEADER</span>
            <form method="POST" action="?op=10">
                <input type="text" name="search">
                <input type="submit">
            </form>
        </header>
        <nav class="my-navbar">
            <ul class="navigation-bar">
                <li><a href="index.php">Home</a></li>
                <li><a href="?op=110">Product List</a></li>
                <li><a href="?op=111">Product Catalogue</a></li>
                <?php
                    if (isset($_SESSION['user_name'])) {
                        echo '<li style="color:lightblue;">'.$_SESSION['user_name'];
                        echo $_SESSION['user_pic']; ?>
                <li><img style="width:30px;height:20px;" src="usermages/<?php
                    echo $_SESSION['user_pic']; ?>"></li>
                <li><a href="index.php?op=5">Logout</a></li>
                <?php
                        if ($_SESSION['user_level'] == 'employee') {
                            ?>
                <li><a href="logout.php?op=5">ErrorLogs</a></li>
                <?php
                        } ?>
                <?php
                    } else { ?>
                <li><a href="?op=12">Login</a></li>

                <?php
                    }
        if (!isset($_SESSION['user_name'])) {
            ?>
                <li><a href="?op=3">Register</a></li>
                <?php
        } ?>
            </ul>
            <?php
                if (isset($_SESSION['user_email'])) {
                    echo $_SESSION['user_name'];
                } ?>
        </nav>
        <main>
            <?=$this->context; ?>


        </main>
    </body>

</html>
<?php
    }
}
