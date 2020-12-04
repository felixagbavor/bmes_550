
<?php

include "../backend.php";
$uploads_dir = '../temp_uploads';
if(isset($_POST["submit"])) {
    $username = $_POST["user_name"];
    $tmp_name = $_FILES["myfile"]["tmp_name"];
    $name = basename($_FILES["myfile"]["name"]);
    $previous = 0;
    if (isset($_POST["previous_results"])){
        $previous=1;
        header("Location: previous_results.php?username=".$username);
    } else{
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $temp_path = "$uploads_dir/$name";
        $output = call_image_processor($temp_path,$username);
        header("Location: results.php?username=".$username."&previous=".$previous."&files=".$output);
    }
    
}

?>