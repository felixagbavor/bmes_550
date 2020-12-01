
<?php

if(isset($_POST["submit"])) {
    $filename = $_FILES["myfile"]["name"];
    $first_line = file($_FILES["myfile"]["tmp_name"])[0];
    echo "<b>Name: </b>".$filename."<br>";
    echo "<b>Size: </b>".$_FILES["myfile"]["size"]."<br>";
}


?>