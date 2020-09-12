<html>

<head>
    <title>
        picture
    </title>
</head>

<body>
    <form enctype="multipart/form-data" action="" method="POST">
        <p>Add an image
            <input type="file" name="product_image">
        </p>
        <input type="submit" value="Upload">
    </form>
</body>

</html>

<?php
    if (!isset($_FILES[$file_input])) {
        return 'No image uploaded';
    }
    if ($_FILES[$file_input]['error'] != UPLOAD_ERR_OK) {
        return 'Error picture upload: code='.$_FILES[$file_input]['error'];
    }
?>