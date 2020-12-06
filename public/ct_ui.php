<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        
?>

<script>
    function containsSpecialCharacters(str){
        var regex = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
        return regex.test(str);
    }

    function validateForm() {
        var x = document.forms["myform"]["user_name"].value;
        var array_users = <?php echo json_encode($users); ?>;
        array_users[0]
        var arr = [];
        for (var i =0;i<array_users.length;i++){
            arr.push(array_users[i][0])
        }
        var prev = document.forms["myform"]["previous_results"].checked;
    
        console.log(arr[x])

        if (x == "") {
            alert("Name must be filled out");
            return false;
        }
        else if(containsSpecialCharacters(x)){
            alert("user name cannot contain any special characters");
            return false
        }
        else if(!arr.includes(x) && prev){
            alert("username doesnt exists");
            return false;
        }
    }


</script>

</head>
<body>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <form name="myform" action="upload.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label>Enter username</label>
		<input name="user_name" required minlength="4"><br><br>
        <label>retrieve previous results?</label>
        <input type="checkbox" id="retrieve" name="previous_results"/><br/><br/>
        <input type='file' id="image" name="myfile" required/>
        <input type="submit" value="submit" name="submit" />
    </form>
    
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
</body>
</html>
