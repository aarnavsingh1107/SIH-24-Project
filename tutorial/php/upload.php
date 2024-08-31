<?php
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>File upload</title>
</head>
<body>
<form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="uploadfile">
        <br>
        <button type="submit" name="submit ">upload file</button>   
    </form>
</body>
</html>
<?php
    $folder="/images";
    //echo $_FILES["uploadfile"];
    print_r($_FILES["uploadfile"]);
?>