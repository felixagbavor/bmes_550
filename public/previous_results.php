<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body >
    <?php
        include "../backend.php";
        $dbfile='../image_db.sqlite'; 
        ####################################################
        # create database connection
        $db = new PDO("sqlite:$dbfile");
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $username = $_REQUEST["username"];
        $table = "images";
        $results = retrieve_user_images($pdo=$db, $table_name=$table, $user=$username);

    ?>
    <p style="text-align:center;font-size:200%">Hello <b><?php echo $username ?></b></p>
    <p style="text-align:center;font-size:120%">Here are your previous results</p>

    <table id="customers">
        <tr>
            <th>Image</th>
            <th>Date processed</th>
        </tr>
            <?php foreach($results as $row): ?>
        <tr>
            <td><a href="<?php print $row["file_id"]; ?>" download> 
            <?php
             $filepath = $row["file_id"];
             $arr = explode("/",$filepath); 
             print $arr[2];
            ?> 
             </a></td>
            <td><?php print $row["upload_datetime"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>