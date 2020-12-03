<html>


<body>
    <?php
        $files = $_REQUEST["files"];
        $username = $_REQUEST["username"]

    ?>
    <p>Hello <b><?php echo $username ?></b></p>
    <p>Here are your results</p>
    <img src="<?php echo $files?>"/>
</body>

</html>