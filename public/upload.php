
<?php

include "../backend.php";
$uploads_dir = '../temp_uploads';
if(isset($_POST["submit"])) {
    $username = $_REQUEST["user_name"];

    $tmp_name = $_FILES["myfile"]["tmp_name"];
    $name = basename($_FILES["myfile"]["name"]);
    
    move_uploaded_file($tmp_name, "$uploads_dir/$name");
    
    $temp_path = "$uploads_dir/$name";
    $output = call_image_processor($temp_path,$username);
    echo $output;
}

?>