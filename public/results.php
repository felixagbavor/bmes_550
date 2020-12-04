<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
        $files = $_REQUEST["files"];
        $arr = explode(":",$files);
        $username = $_REQUEST["username"];
    ?>
    <p style="text-align:center;font-size:200%">Hello <b><?php echo $username ?></b></p>
    <p style="text-align:center;font-size:120%">Here are your results</p>
    <div class="row">
        <div class="column">
            <label>Original</label>
            <img src="<?php echo $arr[0]?>" style="width:100%"/>
        </div>
        <div class="column">
            <label>Processed</label>
            <img src="<?php echo $arr[1]?>" style="width:100%"/>
            <a href="<?php echo $arr[1]?>" style="text-align:center;" download>
                Download Now
            </a>
        </div> 
    </div>
</body>

</html>