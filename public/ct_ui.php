<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        html,body {
            background-color: white;
            height:100%;
            
            margin: 0;
            padding: 0;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }
        body {
            display:flex;
        }
    </style>
<?php
		include "../backend.php";
        $dbfile='../test.sqlite'; 
        ####################################################
        # create database connection
        $db = new PDO("sqlite:$dbfile");
		$table = "images";
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$users = list_distinct_users($pdo=$db,$table_name=$table);
		print_r($users[2][0]);
?>
</head>
<body>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label>Select User: </label>
		<select name="users" id="users">
			<?php
				foreach($users as $u):
					
			?>
        <input type="text" name="user_name" placeholder="Enter your username" required/><br/><br/>
        <label>retrieve previous results?</label>
        <input type="checkbox" id="retrieve" name="previous_results"><br><br>
        <input type='file' id="image" name="myfile" required/>
		
        <input type="submit" value="submit" name="submit">
    </form>
</body>

<script>
    var chbox = document.getElementById("retrieve");
    chbox.addEventListener("click",function(event){

        if(chbox.checked){
            document.getElementById("image").required = false;
        } else{
            document.getElementById("image").required = true;
        }
       
    })
    
</script>

</html>