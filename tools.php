<?php

function array_to_html_table($product)
{
    $r = '';
    $r .= '<style> td,th{border:1px solid black;}</style>';
    $r .= '<table>';
    $r .= '<tr>';
    $r .= '<th>index</th><th>Value</th>';
    $r .= '</tr>';

    foreach ($product as $key => $value) {
        $r .= '<tr>';
        $r .= '<td>'.$key.'</td>';
        $r .= '<td>'.$value.'</td>';
        $r .= '</tr>';
    }
    $r .= '</table>';

    return $r;
}
function array_to_html_table2($product)
{
    $r = '';
    $r .= '<style> td,th{border:1px solid black;}</style>';
    $r .= '<table>';
    $r .= '<tr>';
    $r .= '<th>id</th><th>Name</th>
    <th>Description</th><th>Price</th>
    <th>Pic</th><th>Stock</th>';
    $r .= '</tr>';

    foreach ($product as $value) {
        $r .= '<tr>';
        foreach ($value as $values) {
            $r .= '<td>'.$values.'</td>';
        }
        $r .= '</tr>';
    }
    $r .= '</table>';

    return $r;
}
function array_to_html_table3($product)
{
    $r = '';
    foreach ($product as $value) {
        $r .= array_to_html_table4($value);
    }

    return $r;
}
function Crash($code, $message)
{
    http_response_code($code);
    //mail(COMPANY_EMAIL, COMPANY_NAME, 'Server Crashed Code='.$code, $message); //here email to IT Admin
    $file = fopen('Logs/errors.log', 'a+');
    $time_info = date('d-m-y h i s a');
    fwrite($file, $message.'-'.$time_info.' <br>');
    $message = fread($file, filesize('Logs/errors.log'));
    fclose($file);
    die($message);
}

function array_to_html_table4($product)
{
    $r = "<div class='product'>";
    $r .= '<img src="productimages/'.$product['pic'].'">';
    $r .= '<h1 class="name">'.$product['name'].'</h1>';
    $r .= '<h1 class="description">'.$product['description'].'</h1>';
    $r .= '<h1 class="price">'.$product['price'].'</h1>';
    $r .= '<a href="?op=116&id='.$product['id'].'">edit</a>';
    $r .= '</div>';

    return $r;
}
function Photo_Uploaded_Is_Valid($file_input, $Max_Size = 500000)
{
    //Must havein HTML <form enctype="multipart/form-data" .. //otherwise $_FILE is undefined // $file_input is the file
    //input name on the HTML form
    if (!isset($_FILES[$file_input])) {
        return 'No image uploaded';
    }
    if ($_FILES[$file_input]['error'] != UPLOAD_ERR_OK) {
        return 'Error picture upload: code='
    .$_FILES[$file_input]['error'];
    } // Check image size
    if ($_FILES[$file_input]['size'] > $Max_Size) {
        return 'Image too big, max file size is '.$Max_Size.' Kb';
    }

    // Check that file actually contains an image
    $check = getimagesize($_FILES[$file_input]['tmp_name']);
    if ($check === false) {
        return 'This file is not an image';
    }

    // Check extension is jpg,JPG,gif,png
    $imageFileType = pathinfo(basename($_FILES[$file_input]['name']), PATHINFO_EXTENSION);
    if ($imageFileType != 'jpg' && $imageFileType != 'JPG' && $imageFileType != 'gif' && $imageFileType != 'png') {
        return 'Invalid image file type, valid extensions are: .jpg .JPG .gif .png';
    }

    return 'OK';
}

function Picture_Save_File($file_input, $target_dir)
{
    $message = Photo_Uploaded_Is_Valid($file_input); // voir fonction
    if ($message === 'OK') {
        // Check that there is no file with the same name
        // already exists in the target folder
        // using file_exists()
        $target_file = $target_dir.basename($_FILES[$file_input]['name']);
        if (file_exists($target_file)) {
            return 'This file already exists';
        }

        // Create the file with move_uploaded_file()
        if (move_uploaded_file($_FILES[$file_input]['tmp_name'], $target_file)) {
            // ALL OK display image for testing
            // echo '<img src="'.$target_file.'">';
        } else {
            return 'Error in move_upload_file';
        }
    } else {
        // upload error, invalid image or file too big
        return $message;
    }
}
